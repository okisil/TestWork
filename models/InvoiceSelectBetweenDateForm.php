<?php

namespace app\models;

use yii\base\Model;
use app\services\Parse;
use Yii;

use app\services\CustomerService;

class InvoiceSelectBetweenDateForm extends Model
{

	public $dateAfter;

	public $dateBefore;

	public $id;

   	public function rules(){
    	return [
    	[['dateAfter' , 'dateBefore', 'id'], 'required'],
    ];
    }

    public function __construct(){
      	$this->dateAfter=Parse::getPrevMonth(date('Y-m-d'));
      	$this->dateBefore=date('Y-m-d');
    }

    public function getAllCustomers(){
    	$storage=Yii::$container->get('app\storage\CustomerStorage\CustomerInterfaceExtended');

     	$serviceCustomer = new CustomerService($storage);
     	$countElementModel=(int)$serviceCustomer->CountData();
		return $serviceCustomer->LoadCollection($countElementModel, 0);
    }
    
}