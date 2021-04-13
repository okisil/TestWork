<?php

namespace app\entities;


class UserEntity
{
    private $id;

    private $name;

    private $login;

    private $hash;
    
    public function setId(int $id){
        $this->id=$id;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setName(string $name){
        $this->name=$name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setLogin(string $login){
        $this->login=$login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setHash(string $hash){
        $this->hash=$hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
    
    
}