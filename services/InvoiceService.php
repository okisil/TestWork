<?php

namespace app\services;

use app\storage\InvoiceStorage\InvoiceInterface;
use app\entities\InvoiceEntity;
use app\models\InvoiceForm;
use Yii;

class InvoiceService 
{

	private $storage;

	public function __construct(InvoiceInterface $storage)
		{
			$this->storage=$storage;
		} 


    public function AddModel(InvoiceForm $model){
    	$model->date=Parse::sqlDate($model->date);
    		
		$entity= new InvoiceEntity();

		$entity->setDate($model->date);
		$entity->setId_customer($model->id_customer);
		$entity->setSum(0);
		$entity->setTotal_weight(0);

		$this->storage->add($entity);
	} 

	public function LoadModelArray($id){
		$entity=$this->storage->findOne($id);

		$id=$entity->getId();
		$date=Parse::formDate($entity->getDate());
		$id_customer=$entity->getId_customer();
		$sum=$entity->getSum();
		$total_weight=$entity->getTotal_weight();
		
		return compact('id','date', 'id_customer', 'sum', 'total_weight');
	}

	public function DeleteModel($id){
		$this->storage->delete($id);
	}

	public function UpdateModel(InvoiceForm $model){
		$model->date=Parse::sqlDate($model->date);

		$entity=$this->storage->findOne($model->id);
    		
		$entity->setDate($model->date);
		$entity->setId_customer($model->id_customer);
		
		$this->storage->save($entity);		
	}

	public function getLastId(){
		return $this->storage->getLastId();
	}
}