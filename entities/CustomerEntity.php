<?php

namespace app\entities;


class CustomerEntity
{
    private $id;

    private $name;

    private $status;

    private $address;
    
    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }
    
}