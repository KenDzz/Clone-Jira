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


    public function CreateProject($dataProject) {
        $dataProject['is_exist'] = true;
        return $this->model->create($dataProject);
    }

}
