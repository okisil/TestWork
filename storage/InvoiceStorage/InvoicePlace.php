<?php

namespace app\storage\InvoiceStorage;

use yii\db\Connection;
use app\entities\InvoiceEntity;

class InvoicePlace implements InvoiceInterface
{
	
	protected $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
		
	}

	public function add(InvoiceEntity $entity){
		$sql = "INSERT INTO {{invoice}} ([[date]], [[id_customer]], [[sum]], [[total_weight]]) VALUES (:date, :id_customer, :sum, :total_weight);";
		
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':date', $entity->getDate());
		$command->bindValue(':id_customer', $entity->getId_customer());
		$command->bindValue(':sum', $entity->getSum());
		$command->bindValue(':total_weight', $entity->getTotal_weight());
							
		$command->execute();
	}

	public function save(InvoiceEntity $entity){
		$sql="UPDATE {{invoice}} SET date=:date, id_customer=:id_customer, sum=:sum, total_weight=:total_weight  WHERE id=:id";
			
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':id', $entity->getId());
		$command->bindValue(':date', $entity->getDate());
		$command->bindValue(':id_customer', $entity->getId_customer());
		$command->bindValue(':sum', $entity->getSum());
		$command->bindValue(':total_weight', $entity->getTotal_weight());


		$command->execute();
	}

	public function delete($id){
		$sql="DELETE FROM {{invoice}} where id=:id";
		
		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);

		$command->execute();
	}

	public function findOne($id){
		$sql="SELECT * FROM {{invoice}} WHERE id=:id";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$invoiceRepository=$command->queryOne();

			$entity= new InvoiceEntity();
			$entity->setId($invoiceRepository['id']);
			$entity->setDate($invoiceRepository['date']);
			$entity->setId_customer($invoiceRepository['id_customer']);
			$entity->setSum($invoiceRepository['sum']);
			$entity->setTotal_weight($invoiceRepository['total_weight']);
			
		return $entity;
	}

	public function getLastId(){
		return $this->connection->lastInsertID;
	}

	
}