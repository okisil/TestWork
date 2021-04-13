<?php

namespace app\controllers\auth;

use Yii;
use yii\base\Action;

class LoginOutAction extends Action
{

    public function run()
    {       	
        Yii::$app->user->logout();
        return $this->controller->goHome();
    }

}