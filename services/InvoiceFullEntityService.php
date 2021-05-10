<?php

namespace app\services;

use app\storage\InvoiceStorage\InvoiceInterfaceExtended;
use app\collection\InvoiceCollectionDate;
use Yii;

class InvoiceFullEntityService 
{
	
	private $storage;

	public function __construct(InvoiceInterfaceExtended $storage)
	{
		$this->storage=$storage;
	}

	private function parseHeadEntity($data){
		$newHead=[];
		$newHead['id']=$data->getId();
		$newHead['date']=Yii::$app->formatter->asDate($data->getDate(), 'php:d F Y');
		$newHead['customer_name']=$data->getCustomer_name();
		$newHead['sum']=Yii::$app->formatter->asCurrency($data->getSum());
		$newHead['total_weight']=Yii::$app->formatter->asDecimal($data->getTotal_weight());
		return $newHead;
	}

	private function parseDataEntity($data){
		$ListOfItems=[];

		if ($data) {
			foreach ($data as $ItemDto) {
				$newItem=[];

				$newItem['id']=$ItemDto->getId();
				$newItem['name_product']=$ItemDto->getName_product();
				$newItem['cost']=Yii::$app->formatter->asDecimal($ItemDto->getCost());
				$newItem['weight']=$ItemDto->getWeight();
				$newItem['total']=Yii::$app->formatter->asDecimal($ItemDto->getTotal());
				
				$ListOfItems[]=$newItem;
			}
		}

		return $ListOfItems;
	}

	private function parseCollection($data){
		$ListOfInvoice=[];
		
		foreach ($data as $entity) {
			$invoice=[];
			$invoice['id']=$entity->getMainHead()->getId();
			$invoice['date']=$entity->getMainHead()->getDate();
			$invoice['customer_name']=$entity->getMainHead()->getCustomer_name();
			$invoice['sum']=Yii::$app->formatter->asDecimal($entity->getMainHead()->getSum());
			$invoice['total_weight']=Yii::$app->formatter->asDecimal($entity->getMainHead()->getTotal_weight());
			
			$ListOfInvoice[]=$invoice;	
		}
		return $ListOfInvoice;
	}

	public function LoadFullInvoice($id){
		$data=$this->storage->findFullEntity($id);
		
		$parseHead=$this->parseHeadEntity($data->getMainHead());
		$parseData=$this->parseDataEntity($data->getDataInvoice());

		return ['head' => $parseHead, 'items' => $parseData];	
	}

	public function LoadCollectionDate($date){
		$data=$this->storage->findDate($date);
		return $this->parseCollection($data);
	}

	public function SortCollectionBetweenDate($afterDate, $beforeDate, $page_limit, $page_offset, array $id_customers = null){

        $data=$this->LoadCollectionBetweenDate($afterDate, $beforeDate, $page_limit, $page_offset, $id_customers);

        $first = $data;

        $format_date=Yii::$app->formatter->asDate($first[0]['date'], 'php:d F Y');
        $beginFirst=new InvoiceCollectionDate($first[0]['date'], $format_date);
        $beginFirst->setNewValue($first[0]);
   
        $second[] = $beginFirst;

        $lengthFirst=count($first);

        for ($i=0; $i < $lengthFirst ; $i++) { 
            $lengthSecond=count($second);
            $lastIndexSecond=$lengthSecond-1;

            $aim = false;
            $repeat =false;
            $currentStorage=null;
            for ($j=0; $j < $lengthSecond ; $j++) { 
                if ($second[$j]->getDate() <> $first[$i]['date']) {
                    $aim = true;
                    $format_date=Yii::$app->formatter->asDate($first[$i]['date'], 'php:d F Y');
                    $currentStorage=new InvoiceCollectionDate($first[$i]['date'], $format_date);
                    $currentStorage->setNewValue($first[$i]);
                } else {
                    if ($i <> 0) {
                        $second[$j]->setNewValue($first[$i]);
                    }
                    $repeat = true;
                }
            }

            if ($aim && !$repeat) {
                $second[] = $currentStorage;
            }
        }
    
        return $second;
    }

	public function LoadCollectionBetweenDate($afterDate, $beforeDate, $page_limit, $page_offset, array $id_customers = null){
		$data=$this->storage->findBetweenDate($afterDate, $beforeDate, $page_limit, $page_offset, $id_customers);
		return $this->parseCollection($data);
	}

	public function CountBetweenDate($afterDate, $beforeDate, array $id_customers = null){
		$result=$this->storage->countBetweenDate($afterDate, $beforeDate, $id_customers);
        return $result['COUNT(*)'];
	}

	public function recountInvoice($id){
		$data=$this->storage->recountMainField($id);

		$entity=$this->storage->findOne($id);

		$entity->setSum($data['sum(total)']);
		$entity->setTotal_weight($data['sum(weight)']);

		$this->storage->save($entity);
	} 
}