<?php

namespace App\Repositories;

use App\Models\UserProject;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Response;

class UserProjectRepository extends BaseRepository  implements UserProjectRepositoryInterface
{
    use JsonResponseTrait;

    public function getModel()
    {
        return UserProject::class;
    }


    public function createUserProject($id, $data) {
        $resultData = [];
        foreach ($data as $key => $value) {
            $data = [
                'project_id' => $id,
                'user_id' => $value
            ];
            $result = $this->model->create($data);
            if(!$result){
                $this->respondInvalidQuery(__('project.register.user.bad'));
            }
            $resultData[] = $value;
        }
        return $resultData;

    }

    public function updateUserProject($id, $data) {
        $dataListUserOld = $this->model->where('project_id', $id)->pluck('user_id')->toArray();

        $arrayDiffSql = array_diff($dataListUserOld ?? [],$data ?? []);
        $arrayDiffNew = array_diff($data ?? [],$dataListUserOld ?? []);

        $dataListUserOld = $this->model->where('project_id', $id)->whereIn('user_id', $arrayDiffSql)->delete();
        $resultData = [];
        foreach ($arrayDiffNew as $key => $value) {
            $data = [
                'project_id' => $id,
                'user_id' => $value
            ];
            $result = $this->model->create($data);
            if(!$result){
                $this->respondInvalidQuery(__('project.register.user.bad'));
            }
            $resultData[] = $value;
        }
        return $resultData;
    }


    public function checkUserExitsInProject($userId, $projectId){
        return $this->model->where('project_id', $projectId)->where('user_id', $userId)->first();
    }

    public function getListProjectByUser($userId){
        return $this->model->where('user_id', $userId)->pluck('project_id')->toArray();
    }

    public function deleteListByProjectId($projectId){
        return $this->model->where('project_id', $projectId)->delete();
    }

}
