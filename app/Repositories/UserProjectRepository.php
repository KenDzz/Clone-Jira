<?php

namespace App\Repositories;

use App\Models\UserProject;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Traits\JsonErrorResponseTrait;
use Illuminate\Http\Response;

class UserProjectRepository extends BaseRepository  implements UserProjectRepositoryInterface
{
    use JsonErrorResponseTrait;

    public function getModel()
    {
        return UserProject::class;
    }


    public function CreateUserProject($id, $data) {
        $resultData = [];
        foreach ($data as $key => $value) {
            $data = [
                'project_id' => $id,
                'user_id' => $value
            ];
            $result = $this->model->create($data);
            if(!$result){
                $this->result(__('project.register.user.bad'), Response::HTTP_BAD_REQUEST, false);
            }
            $resultData[] = $value;
        }
        return $resultData;

    }

    public function UpdateUserProject($id, $data) {
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
                $this->result(__('project.register.user.bad'), Response::HTTP_BAD_REQUEST, false);
            }
            $resultData[] = $value;
        }
        return $resultData;
    }


    public function checkUserExitsInProject($userId, $projectId){
        return $this->model->where('project_id', $projectId)->where('user_id', $userId)->first();
    }

}
