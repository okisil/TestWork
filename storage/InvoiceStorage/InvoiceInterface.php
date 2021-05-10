<?php

namespace app\storage\InvoiceStorage;

use app\entities\InvoiceEntity;

interface InvoiceInterface
{
	
	public function add(InvoiceEntity $entity);

	public function save(InvoiceEntity $entity);

	public function delete($id);

	public function findOne($id);

	public function getLastId();
}