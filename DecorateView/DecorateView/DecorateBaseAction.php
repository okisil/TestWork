<?php

namespace app\DecorateView\DecorateView;

use app\DecorateView\Paint;

class DecorateBaseAction implements Paint
{
    public function writeAction(int $id): string
    {
    	return '';
    }

    public function writeAdd(): string
    {
    	return '';
    }
}