<?php

namespace app\storage\CustomerStorage;

use app\entities\CustomerEntity;

interface CustomerInterface
{
	public function add(CustomerEntity $entity);

	public function save(CustomerEntity $entity);

	public function delete($id);

	public function findOne($id);

	public function getLastId();
}