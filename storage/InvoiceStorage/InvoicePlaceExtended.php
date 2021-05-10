<?php

namespace app\storage\InvoiceStorage;

use yii\db\Connection;
use app\entities\InvoiceFullEntity;

use app\dto\InvoiceItemDto;
use app\dto\InvoiceHeadDto;

class InvoicePlaceExtended extends InvoicePlace implements InvoiceInterfaceExtended
{
	
	public function __construct(Connection $connection)
	{
		parent::__construct($connection);			
	}

	public function recountMainField($id){
		$sql="SELECT sum(weight), sum(total) FROM {{listitems}}, {{invoice}} WHERE [[listitems.id_invoice]]=[[invoice.id]] AND [[id_invoice]]=:id";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);

		$Summs=$command->queryOne();

		return $Summs;
	}

	private function findItemsDto($id){
		$sql="SELECT [[listitems.id]], [[listitems.id_invoice]], [[listitems.cost]], [[listitems.weight]], [[listitems.total]], 
		[[product.name]] FROM {{listitems}}, {{product}} WHERE [[id_invoice]]=:id AND [[listitems.id_product]]=[[product.id]]";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$ItemRepository=$command->queryAll();

		if ($ItemRepository) {

			foreach ($ItemRepository as $itemClass) {
				
				$ItemDto= new InvoiceItemDto();
				$ItemDto->setId($itemClass['id']);
				$ItemDto->setName_product($itemClass['name']);
				$ItemDto->setCost($itemClass['cost']);
				$ItemDto->setWeight($itemClass['weight']);
				$ItemDto->setTotal($itemClass['total']);

				$dto[]=$ItemDto;
			}
			return $dto;
		}
	}

	private function findHeadDto($id){
		$sql="SELECT [[invoice.id]], [[invoice.date]], [[invoice.sum]], [[invoice.total_weight]], [[customer.name]] FROM {{invoice}}, {{customer}} WHERE [[invoice.id]]=:id AND [[invoice.id_customer]]=[[customer.id]]";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$invoiceRepository=$command->queryOne();

			$HeadDto= new InvoiceHeadDto();
			$HeadDto->setId($invoiceRepository['id']);
			$HeadDto->setDate($invoiceRepository['date']);
			$HeadDto->setCustomer_name($invoiceRepository['name']);
			$HeadDto->setSum($invoiceRepository['sum']);
			$HeadDto->setTotal_weight($invoiceRepository['total_weight']);
			
		return $HeadDto;
	}

	public function findDate($date){
		$sql="SELECT [[invoice.id]], [[invoice.date]], [[customer.name]], [[invoice.sum]], [[invoice.total_weight]] FROM {{invoice}}, {{customer}} WHERE date=:date AND [[invoice.id_customer]]=[[customer.id]]";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':date', $date);
		
		$invoiceRepository=$command->queryAll();

		$entities=[];

		foreach ($invoiceRepository as $invoiceClass) {
			$entity= new InvoiceFullEntity();

			$HeadDto= new InvoiceHeadDto();
			$HeadDto->setId($invoiceClass['id']);
			$HeadDto->setDate($invoiceClass['date']);
			$HeadDto->setCustomer_name($invoiceClass['name']);
			$HeadDto->setSum($invoiceClass['sum']);
			$HeadDto->setTotal_weight($invoiceClass['total_weight']);

			$entity->setMainHead($HeadDto);
			$entity->setDataInvoice(null);

			$entities[]=$entity;
		}
		return $entities;	
	}

	public function findBetweenDate($afterDate, $beforeDate, $limit, $offset, array $id_customers = null){

	        if ($id_customers <> null) {
	            $subParam='';
	            $newBindParam=[];
	            foreach ($id_customers as $key => $value) {
	                if ($key <> 0) {
	                    $subParam=$subParam.', ';
	                }
	                $subParam=$subParam.':id_customer'.$key;
	                $newBindParam[':id_customer'.$key]=$value;
	            }
	            $sqlAdd=" AND ([[invoice.id_customer]] IN ($subParam))";
	        }


	        $sql="SELECT [[invoice.id]], [[invoice.date]], [[customer.name]], [[invoice.sum]], [[invoice.total_weight]] FROM {{invoice}}, {{customer}} WHERE ([[invoice.date]]>=:date1 AND [[invoice.date]]<=:date2) AND [[invoice.id_customer]]=[[customer.id]]";

	        if ($id_customers <> null) {
	            $sql=$sql.$sqlAdd;
	        }

	        $sql=$sql." LIMIT :count_limit OFFSET :count_offset";

	        $command=$this->connection->createCommand($sql);
	        $command->bindValues([':date1' => $afterDate, ':date2' => $beforeDate, ':count_limit' => $limit, ':count_offset' => $offset]);

	        if ($id_customers <> null) {
	            $command->bindValues($newBindParam);
	        }

	        $invoiceRepository=$command->queryAll();

	        $entities=[];

	        foreach ($invoiceRepository as $invoiceClass) {
	            $entity= new InvoiceFullEntity();

	            $HeadDto= new InvoiceHeadDto();
	            $HeadDto->setId($invoiceClass['id']);
	            $HeadDto->setDate($invoiceClass['date']);
	            $HeadDto->setCustomer_name($invoiceClass['name']);
	            $HeadDto->setSum($invoiceClass['sum']);
	            $HeadDto->setTotal_weight($invoiceClass['total_weight']);

	            $entity->setMainHead($HeadDto);
	            $entity->setDataInvoice(null);

	            $entities[]=$entity;
	        }
	        return $entities;
	}

	public function countBetweenDate($afterDate, $beforeDate, array $id_customers = null){

		if ($id_customers <> null) {
	            $subParam='';
	            $newBindParam=[];
	            foreach ($id_customers as $key => $value) {
	                if ($key <> 0) {
	                    $subParam=$subParam.', ';
	                }
	                $subParam=$subParam.':id_customer'.$key;
	                $newBindParam[':id_customer'.$key]=$value;
	            }
	            $sqlAdd=" AND ([[invoice.id_customer]] IN ($subParam))";
	        }

	   $sql="SELECT COUNT(*) FROM {{invoice}}, {{customer}} WHERE ([[invoice.date]]>=:date1 AND [[invoice.date]]<=:date2) AND [[invoice.id_customer]]=[[customer.id]]";

	   if ($id_customers <> null) {
	            $sql=$sql.$sqlAdd;
	        }

	   $command=$this->connection->createCommand($sql);
	   $command->bindValues([':date1' => $afterDate, ':date2' => $beforeDate]);

	   if ($id_customers <> null) {
	            $command->bindValues($newBindParam);
	        }

	   $count=$command->queryOne();
	   return $count;             
	}

	public function findFullEntity($id){
		$entity= new InvoiceFullEntity();
		$entity->setMainHead($this->findHeadDto($id));
		$entity->setDataInvoice($this->findItemsDto($id));
		return $entity;
	}

	public function findIncompleteEntity($id){
		$MainHead=$this->findHeadDto($id);
		$entity= new InvoiceFullEntity();
		$entity->setMainHead($MainHead);
		$entity->setDataInvoice(null);
		return $entity;
	} 
	
}