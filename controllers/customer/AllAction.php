<?php

namespace app\controllers\customer;

use Yii;
use yii\base\Action;
use yii\data\Pagination;

use app\DecorateView\DecorateView\DecorateBaseAction;
use app\DecorateView\DecorateView\DecorateAddUpdateDeleteAction;

class AllAction extends Action
{

    public function run()
    {
    	$panel = new DecorateBaseAction();
        $panel = new DecorateAddUpdateDeleteAction($panel, 'customer');

        $countElementModel=$this->controller->service->CountData();

		$pages = new Pagination(['totalCount' => $countElementModel, 'defaultPageSize' => 16]);

		$models=$this->controller->service->LoadCollection($pages->limit,$pages->offset);
		return $this->controller->render('index', ['models' => $models, 'pages' => $pages, 'panel' => $panel ]);
    }

}