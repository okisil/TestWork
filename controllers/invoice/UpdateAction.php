<?php

namespace app\controllers\invoice;

use Yii;
use yii\base\Action;
use app\models\InvoiceForm;

class UpdateAction extends Action
{

    public function run($id)
    {
        $arrayFields=$this->controller->service->LoadModelArray($id);
        $model=new InvoiceForm($arrayFields);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->controller->service->UpdateModel($model);    
            return $this->controller->redirect(['/invoiceselect/invoice-select/invoice-date', 'InvoiceSelectForm[date]' => $model->date]);
        }
        return $this->controller->render('update', ['model' => $model]);
    }

}
