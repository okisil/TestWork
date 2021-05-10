<?php

namespace app\storage\ItemStorage;

use yii\db\Connection;
use app\entities\ItemEntity;

class ItemPlace implements ItemInterface
{
	
	public $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
		
	}

	public function add(ItemEntity $entity){
		$sql = "INSERT INTO {{listitems}} ([[id_invoice]], [[id_product]], [[cost]], [[weight]], [[total]]) VALUES (:id_invoice, :id_product, :cost, :weight, :total);";
		
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':id_invoice', $entity->getId_invoice());
		$command->bindValue(':id_product', $entity->getId_product());
		$command->bindValue(':cost', $entity->getCost());
		$command->bindValue(':weight', $entity->getWeight());
		$command->bindValue(':total', $entity->getTotal());
							
		$command->execute(); 
	}

	public function save(ItemEntity $entity){
		$sql="UPDATE {{listitems}} SET id_invoice=:id_invoice, id_product=:id_product, cost=:cost, weight=:weight, total=:total WHERE id=:id";
			
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':id', $entity->getId());
		$command->bindValue(':id_invoice', $entity->getId_invoice());
		$command->bindValue(':id_product', $entity->getId_product());
		$command->bindValue(':cost', $entity->getCost());
		$command->bindValue(':weight', $entity->getWeight());
		$command->bindValue(':total', $entity->getTotal());

		$command->execute();
	}

	public function delete($id){
		$sql="DELETE FROM {{listitems}} where id=:id";
		
		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);

		$command->execute();
	}

	public function findOne($id){
		$sql="SELECT * FROM {{listitems}} where id=:id";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$itemRepository=$command->queryOne();

			$entity= new ItemEntity();
			$entity->setId($itemRepository['id']);
			$entity->setId_invoice($itemRepository['id_invoice']);
			$entity->setId_product($itemRepository['id_product']);
			$entity->setCost($itemRepository['cost']);
			$entity->setWeight($itemRepository['weight']);
			$entity->setTotal($itemRepository['total']);
			
		return $entity;		
	}

	public function getLastId(){
		return $this->connection->lastInsertID;
	}

}