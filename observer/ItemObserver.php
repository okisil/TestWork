<?php

namespace app\observer;

use app\services\ItemService;
use app\services\InvoiceFullEntityService;
use app\models\ItemForm;

use yii\base\BaseObject;

class ItemObserver extends BaseObject 
{	
	public $MasterService;

	public $SlaveService;

	function __construct(ItemService $ItemService, InvoiceFullEntityService $InvoiceFullEntityService)
	{
		$this->MasterService=$ItemService;
		$this->SlaveService=$InvoiceFullEntityService;
		parent::__construct();
	}

	public function init(){
		$this->MasterService->on($this->MasterService::EVENT_AFTER_ADD, function($event){
			$this->SlaveService->recountInvoice($event->id_invoice);
		});
		$this->MasterService->on($this->MasterService::EVENT_AFTER_UPDATE, function($event){
			$this->SlaveService->recountInvoice($event->id_invoice);
		});
		$this->MasterService->on($this->MasterService::EVENT_AFTER_DELETE, function($event){
			$this->SlaveService->recountInvoice($event->id_invoice);
		});
	}

	public function AddModel(ItemForm $model){
		$this->MasterService->AddModel($model);
	}

	public function UpdateModel(ItemForm $model){
		$this->MasterService->UpdateModel($model);
	}

	public function DeleteModel($id){
		$this->MasterService->DeleteModel($id);
	}

	public function LoadModelArray($id){
		return $this->MasterService->LoadModelArray($id);
	}
}