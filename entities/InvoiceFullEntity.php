<?php

namespace app\entities;


class InvoiceFullEntity
{
    private $MainHead;

    private $DataInvoice;

    public function setMainHead($MainHead)
    {
        $this->MainHead = $MainHead;
    }

    public function getMainHead(){
        return $this->MainHead;
    }

    public function setDataInvoice($DataInvoice){
    	$this->DataInvoice=$DataInvoice;
    }
    

    public function getDataInvoice(){
        return $this->DataInvoice;
    }
}