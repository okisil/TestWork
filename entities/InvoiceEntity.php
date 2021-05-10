<?php

namespace app\entities;


class InvoiceEntity
{
    private $id;

    private $date;

    private $id_customer;

    private $sum;

    private $total_weight;
    
    public function setId($id)
    {
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setId_customer($id_customer)
    {
        $this->id_customer = $id_customer;
    }

    public function getId_customer()
    {
        return $this->id_customer;
    }
    

    public function setSum($sum)
    {
        $this->sum = $sum;
    }

    public function getSum()
    {
        return $this->sum;
    }

    public function setTotal_weight($weight)
    {
        $this->total_weight = $weight;
    }

    public function getTotal_weight()
    {
        return $this->total_weight;
    }
}