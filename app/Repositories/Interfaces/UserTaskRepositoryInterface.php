<?php

namespace App\Repositories\Interfaces;

interface UserTaskRepositoryInterface extends BaseRepositoryInterface
{
    public function CreateUserTask($id, $data);

    public function UpdateUserTask($id,$data);
}
