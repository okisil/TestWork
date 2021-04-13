<?php

namespace app\services;

use Yii;
use app\storage\UserStorage\UserInterface;
use app\storage\UserStorage\NotFoundException;
use yii\base\BaseObject;


class UserService extends BaseObject
{

	private $storage;

	public function __construct(UserInterface $storage, $config = [])
	{
		$this->storage=$storage;
		parent::__construct($config);
	}


	public function LoadModelIdArray($id){
		try {
			$entity=$this->storage->findOne($id);

			$id=$entity->getId();
			$name=$entity->getName();
			$login=$entity->getLogin();
			$hash=$entity->getHash();

			$result=compact('id','name', 'login', 'hash');
						
		} catch (NotFoundException $e) {
			$result=null;
		}

		return $result; 		
	}

	public function LoadModelLoginArray($login){
		try {
			$entity=$this->storage->findLogin($login);

			$id=$entity->getId();
			$name=$entity->getName();
			$login=$entity->getLogin();
			$hash=$entity->getHash();

			$result=compact('id','name', 'login', 'hash');

		} catch (NotFoundException $e) {
			$result=null;
		}
 		
 		return $result; 
	}

	public static function existUserByPassword($password, $hash){
		return Yii::$app->getSecurity()->validatePassword($password, $hash);
	}

	public static function getUserRole($id_user){
		$Role=Yii::$app->authManager->getRolesByUser($id_user);
		return array_shift($Role)->name;
	}
	
}