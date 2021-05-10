<?php

namespace app\storage\ItemStorage;

use app\entities\ItemEntity;

interface ItemInterface
{
	
	public function add(ItemEntity $entity);

	public function save(ItemEntity $entity);

	public function delete($id);

	public function findOne($id);

	public function getLastId();

}