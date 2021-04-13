<?php

namespace app\controllers\auth;

use Yii;
use yii\base\Action;
use app\models\AuthForm;
use app\components\User\UserComponent;

class LoginInAction extends Action
{

    public function run()
    {       	
        $model=new AuthForm();
           if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $User=UserComponent::findIdentity($model->getUser()['id']);
             Yii::$app->user->login($User);
             return $this->controller->goHome();
            }

        return $this->controller->render('auth', ['model' => $model]);
    }

}