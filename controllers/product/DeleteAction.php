<?php

namespace app\controllers\product;

use Yii;
use yii\base\Action;
use app\models\ProductForm;

class DeleteAction extends Action
{
    public function run()
    {
        if (Yii::$app->request->post() ) {
            $id=Yii::$app->request->post('id');
            $this->controller->service->DeleteModel($id); 
            return $this->controller->redirect(['/product/product/index']);
        }     
    }

}
