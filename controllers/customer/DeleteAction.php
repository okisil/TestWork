<?php

namespace app\controllers\customer;

use Yii;
use yii\base\Action;
use app\models\CustomerForm;

class DeleteAction extends Action
{

    public function run()
    {
       if (Yii::$app->request->post() ) {
            $id=Yii::$app->request->post('id');
            $this->controller->service->DeleteModel($id);
            return $this->controller->redirect(['customer/customer/index']);
        }
    }

}