<?php

namespace app\DecorateView\DecorateView;

use app\DecorateView\Decorator;

use yii\helpers\Html;

class DecorateEmptyAction extends Decorator
{
    public function writeAction(int $id): string
    {
    	return '<span class="glyphicon glyphicon-ban-circle"></span>';
    }

    public function writeAdd(): string
    {
    	return '';
    }
}