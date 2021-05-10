<?php

namespace app\controllers\invoice;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\services\InvoiceService;

class InvoiceController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['invoice-add', 'invoice-update', 'invoice-delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['tester'],
                    ],
                ],
            ],
        ];
    }


	public $service;

	public function actions()
	{
	    return [
	        'invoice-add' => 'app\controllers\invoice\AddAction',
            'invoice-update' => 'app\controllers\invoice\UpdateAction',
            'invoice-delete' => 'app\controllers\invoice\DeleteAction',
	    ];
	}

    public function __construct($id, $module, InvoiceService $service, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $service;
    }

    public function init(){
       $this->layout='@app/views/invoice/invoiceheadLayout';
       $this->setViewPath('@app/views/invoice');
    }

}
