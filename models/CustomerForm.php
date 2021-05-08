<?php

namespace app\models;

use yii\base\Model;

class CustomerForm extends Model
{

	public $id;
	public $name;
    public $status;
    public $address;
	
   	public function rules(){
    	return [
    	[['name', 'status', 'address'], 'required']
    ];
    }

    public function __construct(array $fields = null, $config = []){
    	parent::__construct($config);
    	$this->id=$fields['id'];
    	$this->name=$fields['name'];
        $this->status=$fields['status'];
        $this->address=$fields['address'];
    }
    
}