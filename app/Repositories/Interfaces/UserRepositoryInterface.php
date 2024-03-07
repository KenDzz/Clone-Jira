<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface  extends BaseRepositoryInterface
{
    public function CreateUser($dataUser);

    public function GetUserNormal();
}
