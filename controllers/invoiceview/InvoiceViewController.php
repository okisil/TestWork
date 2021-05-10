<?php

namespace app\controllers\invoiceview;

use yii\web\Controller;
use yii\filters\AccessControl;

use app\services\InvoiceFullEntityService;

class InvoiceViewController extends Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['invoice-full'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['invoice-full'],
                        'roles' => ['tester'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['invoice-full'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }


	public $service;

	public function actions(){
		return [
			'invoice-full' => 'app\controllers\invoiceview\FullAction',
		];
	}

	public function __construct($id, $module, InvoiceFullEntityService $service, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $service;
    }

    public function init(){
    	$this->layout='@app/views/invoiceview/invoicefullLayout';
    	$this->setViewPath('@app/views/invoiceview');
    }

}