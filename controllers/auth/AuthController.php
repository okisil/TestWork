<?php

namespace app\controllers\auth;

use yii\web\Controller;

class AuthController extends Controller
{

	public function actions()
	{
	    return [
            'login-in' => 'app\controllers\auth\LoginInAction',
            'login-out' => 'app\controllers\auth\LoginOutAction'
	    ];
	}

	public function init(){
	   $this->layout='@app/views/auth/authLayout';
       $this->setViewPath('@app/views/auth');
    }
}