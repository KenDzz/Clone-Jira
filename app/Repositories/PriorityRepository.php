<?php

namespace App\Repositories;

use App\Models\Priority;
use App\Repositories\Interfaces\PriorityRepositoryInterface;

class PriorityRepository extends BaseRepository implements PriorityRepositoryInterface
{
    public function getModel()
    {
        // return Priority::class;
    }
}
