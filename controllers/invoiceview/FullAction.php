<?php

namespace app\controllers\invoiceview;

use yii\base\Action;

use app\DecorateView\DecorateView\DecorateBaseAction;
use app\DecorateView\DecorateView\DecorateAddUpdateDeleteAction;

class FullAction extends Action
{
    public function run($id)
    {
       $panel = new DecorateBaseAction();
       $panel = new DecorateAddUpdateDeleteAction($panel, 'item');

        $model=$this->controller->service->LoadFullInvoice($id);
        return $this->controller->render('index', [ 'model' => $model, 'panel' => $panel]);
    }
}
