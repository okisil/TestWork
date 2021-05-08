<?php

namespace app\storage\CustomerStorage;

interface CustomerInterfaceExtended
{
	
	public function findAll($limit, $offset);

	public function count();
}