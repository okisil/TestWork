<?php

namespace app\DecorateView\DecorateView;

use yii\helpers\Html;
use yii\helpers\Url;

use Yii;

class DecorateOpenAction extends DecorateAddUpdateDeleteAction
{

    public function writeAction(int $id): string
    {
    	$role=Yii::$app->user->identity->getRole();

        if ($role == 'tester') {
            $result = ''; 
        } else {
            $result = parent::writeAction($id);
        }

    	return $result;
    }
}