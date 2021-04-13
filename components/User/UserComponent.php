<?php

namespace app\components\User;

use app\services\UserService;
use yii\base\BaseObject;
use Yii;

class UserComponent extends BaseObject implements \yii\web\IdentityInterface
{
	
	private $service;

	public $id;

	public $username;

	public $login;

    public $role;

	public function __construct(int $id_user, UserService $service, $config = [])
	{
		$this->service=$service;
		$this->setProperty($id_user);
		parent::__construct($config);
	}

	private function setProperty($id_user){
		$entity=$this->service->LoadModelIdArray($id_user);
        $role=$this->service::getUserRole($entity['id']);

		$this->id=$entity['id'];
		$this->username=$entity['name'];
		$this->login=$entity['login'];
        $this->role=$role;
	}

	public static function findIdentity($id)
    {
        return Yii::createObject([
           	'class' => static::className()], [$id]);     
    }
 
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }
 
    public function getId()
    {
          return $this->id;
    }

    public function getUsername(){
    	return $this->username;
    }

    public function getLogin(){
    	return $this->login;
    }
 
    public function getAuthKey()
    {
        //return $this->authKey;
    }
 
    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
    }

    public function getRole(){
        return $this->role;
    }

}