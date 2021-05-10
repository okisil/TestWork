<?php

namespace app\storage\InvoiceStorage;

interface InvoiceInterfaceExtended
{
	public function findFullEntity($id);

	public function findIncompleteEntity($id);

	public function findDate($date);
}