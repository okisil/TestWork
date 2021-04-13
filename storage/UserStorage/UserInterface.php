<?php

namespace app\storage\UserStorage;

use app\entities\UserEntity;

interface UserInterface
{
    public function findOne(int $id): UserEntity;

    public function findLogin(string $login): UserEntity;
}
