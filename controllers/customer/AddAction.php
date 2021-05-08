<?php

namespace app\controllers\customer;

use Yii;
use yii\base\Action;
use app\models\CustomerForm;

class AddAction extends Action
{

    public function run()
    {
        $model=new CustomerForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          	$this->controller->service->AddModel($model);
            return $this->controller->redirect(['customer/customer/index']);
        }
        return $this->controller->render('create',['model' => $model]);
    }

}