<?php

namespace app\controllers\item;

use yii\web\Controller;
use yii\filters\AccessControl;

use app\observer\ItemObserver;

class ItemController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['item-add', 'item-delete', 'item-update'],
                'rules' => [
                    [
                        'allow' => true,
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
            'item-add' =>'app\controllers\item\AddAction',
            'item-delete' => 'app\controllers\item\DeleteAction',
            'item-update' => 'app\controllers\item\UpdateAction',
        ];
    }

    public function __construct($id, $module, ItemObserver $service, $config = [])
    {
	   	parent::__construct($id, $module, $config);	
        $this->service = $service;
    }

    public function init(){
        $this->layout='@app/views/item/itemLayout';
        $this->setViewPath('@app/views/item');
    }
    
}
