<?php

namespace app\entities;

class ItemEntity
{
    private $id;

    private $id_invoice;

    private $id_product;

    private $cost;

    private $weight;

    private $total;

        
    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId_invoice($id_invoice){
        $this->id_invoice=$id_invoice;
    }

    public function getId_invoice(){
        return $this->id_invoice;
    }

    public function setId_product($id_product){
        $this->id_product=$id_product;
    }

    public function getId_product(){
        return $this->id_product;
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