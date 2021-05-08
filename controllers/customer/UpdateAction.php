<?php

namespace app\controllers\customer;

use Yii;
use yii\base\Action;
use app\models\CustomerForm;

class UpdateAction extends Action
{

    public function run($id)
    {
        $arrayFields=$this->controller->service->LoadModelArray($id);
		$model=new CustomerForm($arrayFields);       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->controller->service->UpdateModel($model);	
            return $this->controller->redirect(['customer/customer/index']);
        }   
        return $this->controller->render('update', ['model' => $model]);
    }

}