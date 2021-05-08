<?php

namespace app\storage\CustomerStorage;

use yii\db\Connection;
use app\entities\CustomerEntity;

class CustomerPlace implements CustomerInterface
{
	
	protected $connection;
	
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
		
	}

	public function add(CustomerEntity $entity){
		$sql = "INSERT INTO {{customer}} ([[name]], [[status]], [[address]]) VALUES (:name, :status, :address);";
		
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':name', $entity->getName());
		$command->bindValue(':status', $entity->getStatus());
		$command->bindValue(':address', $entity->getAddress());
							
		$command->execute();
	}

	public function save(CustomerEntity $entity){
		$sql="UPDATE {{customer}} SET name=:name, status=:status, address=:address WHERE id=:id";
			
		$command = $this->connection->createCommand($sql);
		$command->bindValue(':id', $entity->getId());
		$command->bindValue(':name', $entity->getName());
		$command->bindValue(':status', $entity->getStatus());
		$command->bindValue(':address', $entity->getAddress());

		$command->execute();
		
	}

	public function delete($id){
		$sql="DELETE FROM {{customer}} where id=:id";
		
		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);

		$command->execute();
	}

	public function findOne($id){
		$sql="SELECT * FROM {{customer}} where id=:id";

		$command=$this->connection->createCommand($sql);
		$command->bindValue(':id', $id);
		
		$customerRepository=$command->queryOne();

			$entity= new CustomerEntity();
			$entity->setId($customerRepository['id']);
			$entity->setName($customerRepository['name']);
			$entity->setStatus($customerRepository['status']);
			$entity->setAddress($customerRepository['address']);
			
		return $entity;
	}

	public function getLastId(){
		return $this->connection->lastInsertID;
	}

}