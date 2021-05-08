<?php

namespace app\controllers\product;

use Yii;
use yii\web\Controller;
use app\services\ProductService;
use yii\data\Pagination;
use yii\filters\AccessControl;


class ProductController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['product-add', 'product-update', 'product-delete', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['tester'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['product-add', 'product-update', 'product-delete'],
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
	        'product-add' => 'app\controllers\product\AddAction',
            'product-update' => 'app\controllers\product\UpdateAction',
            'product-delete' => 'app\controllers\product\DeleteAction',
            'index' => 'app\controllers\product\AllAction',
	    ];
	}

    public function __construct($id, $module, ProductService $service, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $service;
    }

    public function init(){
       $this->layout='@app/views/product/productLayout';
       $this->setViewPath('@app/views/product');
    }

}
