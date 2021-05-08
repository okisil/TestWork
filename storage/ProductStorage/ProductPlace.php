<?php

namespace app\storage\ProductStorage;

use yii\db\Connection;
use app\entities\ProductEntity;

class ProductPlace implements ProductInterface
{
	
	protected $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
		
	}

	public function add(ProductEntity $entity){
		$sql = "INSERT INTO {{product}} ([[name]]) VALUES (:name);";
		
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':name', $entity->getName());
							
		$command->execute();
	}

	public function save(ProductEntity $entity){
		$sql="UPDATE {{product}} SET name=:name WHERE id=:id";
			
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':name', $entity->getName());
		$command->bindValue(':id', $entity->getId());

		$command->execute();
	}

	public function delete($id){
		$sql="DELETE FROM {{product}} where id=:id";
		
		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);

		$command->execute();
	}

	public function findOne($id){
		$sql="SELECT * FROM {{product}} where id=:id";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$productRepository=$command->queryOne();

			$entity= new ProductEntity();
			$entity->setId($productRepository['id']);
			$entity->setName($productRepository['name']);
			
		return $entity;
	}

	public function getLastId(){
		return $this->connection->lastInsertID;
	}
	
}