<?php

namespace app\models;

use yii\base\Model;

use app\services\CustomerService;

use Yii;


class InvoiceForm extends Model
{

	public $id;
	public $date;
	public $id_customer;

   	public function rules(){
    	return [
    	[['date', 'id_customer'], 'required'],
    ];
    }
    
    public function getAllCustomers(){
    	$storage=Yii::$container->get('app\storage\CustomerStorage\CustomerInterfaceExtended');

     	$serviceCustomer = new CustomerService($storage);
     	$countElementModel=(int)$serviceCustomer->CountData();
		return $serviceCustomer->LoadCollection($countElementModel, 0);
    }

    public function __construct(array $fields = null, $config = []){
        parent::__construct($config);
        $this->id=$fields['id'];
        $this->date=$fields['date'];
        $this->id_customer=$fields['id_customer'];
    }
}