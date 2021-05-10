<?php

namespace app\dto;


class InvoiceItemDto
{
    private $id;

    private $name_product;

    private $cost;

    private $weight;

    private $total;
        
    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName_product($name){
        $this->name_product=$name;
    }

    public function getName_product(){
        return $this->name_product;
    }

    public function setCost($cost){
        $this->cost=$cost;
    }

    public function getCost(){
        return $this->cost;
    }

    public function setWeight($weight){
        $this->weight=$weight;
    }

    public function getWeight(){
        return $this->weight;
    }

    public function setTotal($total){
        $this->total=$total;
    }

    public function getTotal(){
        return $this->total;
    }    
}