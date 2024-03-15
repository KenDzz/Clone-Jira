<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllTask($id);
}
