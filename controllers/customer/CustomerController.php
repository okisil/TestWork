<?php

namespace app\controllers\customer;

use Yii;
use yii\web\Controller;
use app\services\CustomerService;
use yii\filters\AccessControl;

class CustomerController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['customer-add', 'customer-update', 'customer-delete', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['tester'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['customer-add', 'customer-update', 'customer-delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }



	public $service;

	public function actions()
	{
	    return [
	        'customer-add' => 'app\controllers\customer\AddAction',
            'customer-update' => 'app\controllers\customer\UpdateAction',
            'customer-delete' => 'app\controllers\customer\DeleteAction',
            'index' => 'app\controllers\customer\AllAction',
	    ];
	}

    public function __construct($id, $module, CustomerService $service, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $service;
    }

    public function init(){
       $this->layout='@app/views/customer/customerLayout';
       $this->setViewPath('@app/views/customer');
    }

}
