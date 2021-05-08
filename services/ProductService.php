<?php

namespace app\services;

use Yii;

use app\storage\ProductStorage\ProductInterfaceExtended;
use app\entities\ProductEntity;
use app\models\ProductForm;

class ProductService 
{
	
	private $storage;

	public function __construct(ProductInterfaceExtended $storage)
		{
			$this->storage=$storage;
		}

	public function AddModel(ProductForm $model){
		$entity= new ProductEntity();

		$entity->setName($model->name);

		$this->storage->add($entity);
	} 

	public function LoadModelArray($id){
		$entity=$this->storage->findOne($id);

		$id=$entity->getId();
		$name=$entity->getName();
		
		return compact('id','name');
	}

	public function DeleteModel($id){
		$this->storage->delete($id);
	}

	public function UpdateModel(ProductForm $model){
		$entity= new ProductEntity();

		$entity->setId($model->id);
		$entity->setName($model->name);
		
		$this->storage->save($entity);		
	} 	

	public function getLastId(){
		return $this->storage->getLastId();
	}

    public function LoadCollection($page_limit, $page_offset){
		$entities=$this->storage->findAll($page_limit, $page_offset);

		$storeArrays=[];

		foreach ($entities as $entity) {
			$id=$entity->getId();
			$name=$entity->getName();
			
			$storeArrays[]=compact('id','name');
		}

		return $storeArrays;
	}

	public function CountData(){
		$result=$this->storage->count();
		return $result['COUNT(*)'];
	} 
}