<?php

namespace app\models;

use yii\base\Model;
use app\services\UserService;
use Yii;

class AuthForm extends Model
{
    public $login;
    public $password;

    private $_user;
    
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'email'],
            ['login', 'validateLogin'],
            ['password', 'validatePassword']
        ];
    }

    public function validateLogin($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Incorrect login.');
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
        	$user = $this->getUser();
        	$existPassword = UserService::existUserByPassword($this->password, $user['hash']);
            if (!$existPassword || !$user) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function getUser()
    {
        $service=Yii::createObject([
            'class' => UserService::className()]);

        if ($this->_user == false) {
            $this->_user = $this->_user=$service->LoadModelLoginArray($this->login);
        }

        return $this->_user;
    }


}    
