<?php

namespace app\storage\ProductStorage;

interface ProductInterfaceExtended
{
	
	public function findAll($limit, $offset);

	public function count();
}