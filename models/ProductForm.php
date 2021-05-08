<?php

namespace app\models;

use yii\base\Model;

class ProductForm extends Model
{

	public $id;
	public $name;
	
   	public function rules(){
    	return [
    	[['name'], 'required']
    ];
    }

    public function __construct(array $fields = null, $config = []){
    	parent::__construct($config);
    	$this->id=$fields['id'];
    	$this->name=$fields['name'];
    }
    
}