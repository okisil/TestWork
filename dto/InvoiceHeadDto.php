<?php

namespace app\dto;


class InvoiceHeadDto
{
    private $id;

    private $date;

    private $customer_name;

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

    public function setCustomer_name($customer_name)
    {
        $this->customer_name = $customer_name;
    }

    public function getCustomer_name()
    {
        return $this->customer_name;
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