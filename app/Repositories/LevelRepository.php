<?php

namespace App\Repositories;

use App\Models\Level;
use App\Repositories\Interfaces\LevelRepositoryInterface;

class LevelRepository extends BaseRepository implements LevelRepositoryInterface
{
    public function getModel()
    {
        return Level::class;
    }
}
