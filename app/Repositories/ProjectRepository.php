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


    public function GetALLMultiProject($dataProject){
        return $this->model->whereIn('id', $dataProject)->get();
    }


    public function CreateProject($dataProject) {
        return $this->model->create($dataProject);
    }

}
