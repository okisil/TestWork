<?php

namespace app\services;

use app\storage\CustomerStorage\CustomerInterfaceExtended;
use app\entities\CustomerEntity;
use app\models\CustomerForm;
use Yii;

class CustomerService 
{

	private $storage;

	public function __construct(CustomerInterfaceExtended $storage)
	{
		$this->storage=$storage;
	} 

	public function AddModel(CustomerForm $model){
		$entity= new CustomerEntity();

		$entity->setName($model->name);
		$entity->setStatus($model->status);
		$entity->setAddress($model->address);

		$this->storage->add($entity);		
	}	

	public function LoadModelArray($id){
		$entity=$this->storage->findOne($id);

		$id=$entity->getId();
		$name=$entity->getName();
		$status=$entity->getStatus();
		$address=$entity->getAddress();
		
		return compact('id','name', 'status', 'address');
	}

	public function DeleteModel($id){
		$this->storage->delete($id);
	}

	public function UpdateModel(CustomerForm $model){
		$entity= new CustomerEntity();

		$entity->setId($model->id);
		$entity->setName($model->name);
		$entity->setStatus($model->status);
		$entity->setAddress($model->address);
		
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
			$status=$entity->getStatus();
			$address=$entity->getAddress();
			
			$storeArrays[]=compact('id','name', 'status', 'address');
		}

		return $storeArrays;
	}

	public function CountData(){
		$result=$this->storage->count();
		return $result['COUNT(*)'];
	}

}