<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function getModel()
    {
        return Project::class;
    }


    public function getALLMultiProject($dataProject){
        return $this->model->whereIn('id', $dataProject)->get();
    }


    public function createProject($dataProject) {
        return $this->model->create($dataProject);
    }

}
