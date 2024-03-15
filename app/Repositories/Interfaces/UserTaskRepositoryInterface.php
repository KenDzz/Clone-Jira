<?php

namespace App\Repositories\Interfaces;

interface UserTaskRepositoryInterface extends BaseRepositoryInterface
{
    public function createUserTask($id, $data);

    public function updateUserTask($id,$data);
}
