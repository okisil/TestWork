<?php

namespace app\models;

use yii\base\Model;

class InvoiceSelectForm extends Model
{

	public $date;

   	public function rules(){
    	return [
    	[['date'], 'required'],
    ];
    }
    
}