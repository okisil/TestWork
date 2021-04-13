<?php

namespace app\storage\UserStorage;

use yii\db\Connection;
use app\entities\UserEntity;

class UserPlace implements UserInterface
{
       
       protected $connection;
       
       public function __construct(Connection $connection)
       {
               $this->connection = $connection;
               
       }

       public function findOne(int $id):UserEntity
       {
       		$sql="SELECT * FROM {{users}} where id=:id";

            $command=$this->connection->createCommand($sql);
            $command->bindValue(':id', $id);
                
            $userRepository=$command->queryOne();

            if (!$userRepository) {
                  throw new NotFoundException('User '.$id.' not found.');
            }

            $entity= new UserEntity();

            $entity->setId($userRepository['id']);
            $entity->setName($userRepository['name']);
            $entity->setLogin($userRepository['login']);
            $entity->setHash($userRepository['hash']);
        
            return $entity;
       }

       public function findLogin(string $login):UserEntity
       {
       		$sql="SELECT * FROM {{users}} where login=:login";

            $command=$this->connection->createCommand($sql);
            $command->bindValue(':login', $login);
                
            $userRepository=$command->queryOne();

            if (!$userRepository) {
                  throw new NotFoundException('User '.$login.' not found.');
            }

           $entity= new UserEntity();

            $entity->setId($userRepository['id']);
            $entity->setName($userRepository['name']);
            $entity->setLogin($userRepository['login']);
            $entity->setHash($userRepository['hash']);        
        
            return $entity;
       }

    
}
