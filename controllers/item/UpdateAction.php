<?php

namespace app\controllers\item;

use Yii;
use yii\base\Action;
use app\models\ItemForm;

class UpdateAction extends Action
{
    public function run($id)
    {
       $host=Yii::$app->request->headers['host'];
       $lastPage=Yii::$app->request->referrer;

       $patternIn='/'.$host.'\/invoiceview\/invoice-view\/invoice-full\?id=[0-9]+$/';
       $patternId='/[0-9]+$/';

        $arrayFields=$this->controller->service->LoadModelArray($id);
        $model=new ItemForm($arrayFields);
       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          $this->controller->service->UpdateModel($model);  
          return $this->controller->redirect(['invoiceview/invoice-view/invoice-full', 'id' => $model->id_invoice]);
        }

        if (preg_match($patternIn, $lastPage)) {
          preg_match($patternId, $lastPage, $id);
          $model->id_invoice=array_shift($id);
          return $this->controller->render('update',['model' => $model]);
        }

       			
    }
    	
    
}
