<?php

namespace app\collection;

class InvoiceCollectionDate 
{
	public $date;

	public $format_date;

	public $storage=[];

	public function getDate(){
		return $this->date;
	}

	/*public function getFormatDate(){
		return $this->format_date;
	}*/

	public function setNewValue($value){
		$this->storage[]=$value;
	}
	
	function __construct($date, $format_date)
	{
		$this->date=$date;
		$this->format_date=$format_date;
	}
}