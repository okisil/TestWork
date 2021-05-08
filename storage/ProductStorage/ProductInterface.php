<?php

namespace app\storage\ProductStorage;

use app\entities\ProductEntity;

interface ProductInterface
{
	
	public function add(ProductEntity $entity);

	public function save(ProductEntity $entity);

	public function delete($id);

	public function findOne($id);

	public function getLastId();

}