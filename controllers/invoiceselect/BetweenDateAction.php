<?php

namespace app\controllers\invoiceselect;

use yii\base\Action;
use yii\data\Pagination;
use app\models\InvoiceSelectBetweenDateForm;
use app\services\Parse;
use Yii;

use app\DecorateView\DecorateView\DecorateBaseAction;
use app\DecorateView\DecorateView\DecorateOpenAction;

class BetweenDateAction extends Action
{
    public function run()
    {
    	$dateForm=new InvoiceSelectBetweenDateForm();
    	
    	$models=null;
    	$pages=null;

        $panel = new DecorateBaseAction();
        $panel = new DecorateOpenAction($panel, 'invoice');


    	if ($dateForm->load(Yii::$app->request->get())) {

    		$dateAfter=Parse::sqlDate($dateForm->dateAfter);
    		$dateBefore=Parse::sqlDate($dateForm->dateBefore);
    		
    		$countElementModel=$this->controller->service->CountBetweenDate($dateAfter,$dateBefore, $dateForm->id);

    		if ($countElementModel > 0) {

    			$pages = new Pagination(['totalCount' => $countElementModel, 'defaultPageSize' => 16]);

    			$models=$this->controller->service->SortCollectionBetweenDate($dateAfter, $dateBefore, $pages->limit,$pages->offset, $dateForm->id); 
    		}

    		return $this->controller->render('index_between_date',['models' => $models, 'pages' => $pages, 'dateForm' => $dateForm, 'panel' => $panel ]); 

    			
    	}

    	return $this->controller->render('index_between_date',['models' => $models, 'pages' => $pages, 'dateForm' => $dateForm, 'panel' => $panel ]);

    }
}