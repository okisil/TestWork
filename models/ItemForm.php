<?php

namespace app\models;

use yii\base\Model;

use app\services\ProductService;
use Yii;

class ItemForm extends Model
{

	public $id;
	public $id_product;
    public $id_invoice;
	public $cost;
	public $weight;

   	public function rules(){
    	return [
    	[['id_product' , 'cost' ,'weight', 'id_invoice'], 'required']
    ];
    }

    public function getAllProducts(){
    	$storage=Yii::$container->get('app\storage\ProductStorage\ProductInterfaceExtended');

     	$serviceProduct = new ProductService($storage);
     	$countElementModel=(int)$serviceProduct->CountData();
		return $serviceProduct->LoadCollection($countElementModel, 0);
    }

    public function __construct(array $fields = null, $config = []){
    	parent::__construct($config);
    	$this->id=$fields['id'];
    	$this->id_product=$fields['id_product'];
    	$this->cost=$fields['cost'];
    	$this->weight=$fields['weight'];
    	$this->id_invoice=$fields['id_invoice'];
    }

    public function attributeLabels()
    {
        return [
            'id_product' => 'Name of product',
        ];
    }
    
}