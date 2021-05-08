<?php

namespace app\controllers\product;

use Yii;
use yii\base\Action;
use app\models\ProductForm;

class UpdateAction extends Action
{

    public function run($id)
    {
        $arrayFields=$this->controller->service->LoadModelArray($id);
		$model=new ProductForm($arrayFields);       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->controller->service->UpdateModel($model);	
            return $this->controller->redirect(['product/product/index']);
        }   
        return $this->controller->render('update', ['model' => $model]);
    }

}