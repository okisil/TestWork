<?php

namespace app\controllers\invoice;

use Yii;
use yii\base\Action;
use app\models\InvoiceForm;

class AddAction extends Action
{

    public function run()
    {
        $model=new InvoiceForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->controller->service->AddModel($model);
            $id=$this->controller->service->getLastId();
            return $this->controller->redirect(['/invoiceview/invoice-view/invoice-full', 'id' => $id]);
        }
        return $this->controller->render('create',['model' => $model]);
    }

}
