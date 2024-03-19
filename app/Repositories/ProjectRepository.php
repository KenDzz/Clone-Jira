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


    public function getAllByIds($ids){
        $isExist = true;
        return $this->model->with("userProjects")->whereHas("userProjects",function($q) use($isExist,$ids){
            $q->whereIn('id', $ids);
            $q->where("is_exist",$isExist);
        })->get();
    }


    public function createProject($dataProject) {
        return $this->model->create($dataProject);
    }

    public function deleteProject($id){
        $projectInfo['is_exist'] = false;
        return $this->update($id, $projectInfo);
    }


    public function getAllIsExist(){
        $isExist = true;
        return $this->model->with("userProjects")->whereHas("userProjects",function($q) use($isExist){
            $q->where("is_exist",$isExist);
        })->get();
    }

}
