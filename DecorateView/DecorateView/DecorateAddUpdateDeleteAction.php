<?php

namespace app\DecorateView\DecorateView;

use yii\helpers\Html;
use yii\helpers\Url;

use Yii;

class DecorateAddUpdateDeleteAction extends DecorateEmptyAction
{
    public function writeAction(int $id): string
    {
    	$role=Yii::$app->user->identity->getRole();

    	if ($role == 'tester') {
    		$result = parent::writeAction($id);
    	} else {
    		$path=(string)$this->getNameController();

    		$buttonDelete = Html::a('<span class="glyphicon glyphicon-trash"></span>',
			Url::to(["/$path/$path/$path-delete"]), 
			['data' => 
				['method' => 'POST', 
			 	'params' => ['id' => $id ]
				]
			]);

	    	$buttonUpdate = Html::a('<span class="glyphicon glyphicon-pencil"></span>' ,
				Url::to(["/$path/$path/$path-update", 'id' => $id ]));

	    	$result = $buttonDelete.$buttonUpdate;
    	}

		return 	$result;
    }

    public function writeAdd(): string
    {
    	$role=Yii::$app->user->identity->getRole();

    	if ($role == 'tester') {
    		$result = parent::writeAdd();
    	} else {
    		$path=(string)$this->getNameController();
    		$result = Html::a('Add', Url::to(["/$path/$path/$path-add"]), ['class' => 'btn btn-primary', 'id' => 'elAdd' ]);
    	}

   		return $result;
    }
}