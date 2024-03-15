<?php

namespace App\Repositories;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function getModel()
    {
        return Task::class;
    }


    public function getAllTask($id){
        return $this->model->where("project_id", $id)->get();
    }

}
