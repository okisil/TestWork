<?php

namespace app\controllers\invoice;

use Yii;
use yii\base\Action;
use app\models\InvoiceForm;

class DeleteAction extends Action
{

    public function run()
    {
    	if (Yii::$app->request->post() ) {
            $id=Yii::$app->request->post('id');
            $lastPage=Yii::$app->request->referrer;
    		$patternDate='/[0-9]{1,2}-[0-9]{2}-[0-9]{4}$/';
    		preg_match($patternDate, $lastPage, $date);
            $this->controller->service->DeleteModel($id);
            return $this->controller->redirect(['/invoiceselect/invoice-select/invoice-date', 'InvoiceSelectForm[date]' => array_shift($date)]);
        }
    }

}
