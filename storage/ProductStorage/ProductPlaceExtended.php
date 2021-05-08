<?php

namespace app\storage\ProductStorage;

use yii\db\Connection;
use app\entities\ProductEntity;

class ProductPlaceExtended extends ProductPlace implements ProductInterfaceExtended
{
	
	public function __construct(Connection $connection)
	{
 		parent::__construct($connection);	
	}

	public function findAll($limit, $offset){
		$sql="SELECT * FROM {{product}} LIMIT :count_limit OFFSET :count_offset";

		$command = $this->connection->createCommand($sql);
		$command->bindValue(':count_limit', $limit);
		$command->bindValue(':count_offset', $offset);

		$productRepository=$command->queryAll();

		$entities=[];

		foreach ($productRepository as $productClass) {
			$entity= new ProductEntity();
			$entity->setId($productClass['id']);
			$entity->setName($productClass['name']);
			$entities[]=$entity;
		}
		return $entities;
	}

	public function count(){
		$sql="SELECT COUNT(*) FROM {{product}}";

		$command=$this->connection->createCommand($sql);
		$count=$command->queryOne();

		return $count; 
	}
	
}