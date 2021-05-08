<?php

namespace app\DecorateView;

interface Paint
{
    public function writeAction(int $id): string;

    public function writeAdd():string;
}