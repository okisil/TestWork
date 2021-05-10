<?php

namespace app\controllers\invoiceselect;

use yii\web\Controller;
use yii\filters\AccessControl;

use app\services\InvoiceFullEntityService;
use app\services\CustomerService;

use yii\helpers\Url;

class InvoiceSelectController extends Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['invoice-date', 'invoice-between-date'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['tester', 'admin'],
                    ],
                ],
            ],
        ];
    }


	public $service;

	public $addservice;

	public function actions(){
		return [
			'invoice-date' => 'app\controllers\invoiceselect\DateAction',
			'invoice-between-date' => 'app\controllers\invoiceselect\BetweenDateAction',
		];
	}

	public function __construct($id, $module, InvoiceFullEntityService $InvoiceService,  CustomerService $CustomerService, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $InvoiceService;
        $this->addservice = $CustomerService;
    }

    public function init(){
    	$this->layout='@app/views/invoiceselect/invoiceselectLayout';
    	$this->setViewPath('@app/views/invoiceselect');
    	$this->on(self::EVENT_BEFORE_ACTION, function($event){
    		Url::remember();
    	});
    }

}