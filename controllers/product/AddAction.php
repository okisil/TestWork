<?php

namespace app\controllers\product;

use Yii;
use yii\base\Action;
use app\models\ProductForm;

class AddAction extends Action
{

    public function run()
    {
        $model=new ProductForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->controller->service->AddModel($model);
            return $this->controller->redirect(['product/product/index']);
        }
        return $this->controller->render('create',['model' => $model]);
    }

}
