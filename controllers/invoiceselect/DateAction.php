<?php

namespace app\controllers\invoiceselect;

use yii\base\Action;
use app\models\InvoiceSelectForm;
use Yii;
use app\services\Parse;

use app\DecorateView\DecorateView\DecorateBaseAction;
use app\DecorateView\DecorateView\DecorateOpenAction;

class DateAction extends Action
{
    public function run()
    {
    	$dateForm=new InvoiceSelectForm();
    	if ($dateForm->load(Yii::$app->request->get())) {
    		$dateForm->date=Parse::sqlDate($dateForm->date);

            $panel = new DecorateBaseAction();
            $panel = new DecorateOpenAction($panel, 'invoice');

    		$models=$this->controller->service->LoadCollectionDate($dateForm->date);
    		return $this->controller->render('index_date', [ 'models' => $models, 'dateForm' => $dateForm, 'panel' => $panel ]);
    	}
    	return $this->controller->render('_formDate',['dateForm' => $dateForm]);
    }
}
