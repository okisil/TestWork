<?php

namespace app\storage\CustomerStorage;

use yii\db\Connection;
use app\entities\CustomerEntity;

class CustomerPlaceExtended extends CustomerPlace implements CustomerInterfaceExtended
{
	
	public function __construct(Connection $connection)
	{
 		parent::__construct($connection);	
	}

	public function findAll($limit, $offset){
		$sql="SELECT * FROM {{customer}} LIMIT :count_limit OFFSET :count_offset";

		$command = $this->connection->createCommand($sql);
		$command->bindValue(':count_limit', $limit);
		$command->bindValue(':count_offset', $offset);

		$customerRepository=$command->queryAll();

		$entities=[];

		foreach ($customerRepository as $customerClass) {
			$entity= new CustomerEntity();
			$entity->setId($customerClass['id']);
			$entity->setName($customerClass['name']);
			$entity->setStatus($customerClass['status']);
			$entity->setAddress($customerClass['address']);

			$entities[]=$entity;
		}
		return $entities;	
	}

	public function count(){
		$sql="SELECT COUNT(*) FROM {{customer}}";

		$command=$this->connection->createCommand($sql);
		$count=$command->queryOne();

		return $count; 
	}
	
}