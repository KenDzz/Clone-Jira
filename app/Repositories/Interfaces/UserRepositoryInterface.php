<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface  extends BaseRepositoryInterface
{
    public function createUser($dataUser);

    public function getUserNormal();
}
