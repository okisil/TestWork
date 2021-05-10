<?php

namespace app\controllers\item;

use Yii;
use yii\base\Action;

use yii\helpers\VarDumper;

class DeleteAction extends Action
{
    public function run()
    {
      $lastPage=Yii::$app->request->referrer;
      $patternId='/[0-9]+$/';
      preg_match($patternId, $lastPage, $id_invoice);
      $id_item=Yii::$app->request->post('id');
      $this->controller->service->DeleteModel($id_item);
      return $this->controller->redirect(['invoiceview/invoice-view/invoice-full', 'id' => array_shift($id_invoice)]);   
   			
    }
    	
    
}
