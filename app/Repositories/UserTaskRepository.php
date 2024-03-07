<?php

namespace App\Repositories;

use App\Models\UserTask;
use App\Repositories\Interfaces\UserTaskRepositoryInterface;
use App\Traits\JsonErrorResponseTrait;
use Illuminate\Http\Response;

class UserTaskRepository extends BaseRepository implements UserTaskRepositoryInterface
{

    use JsonErrorResponseTrait;

    public function getModel()
    {
        return UserTask::class;
    }

    public function CreateUserTask($id, $data){
        $resultData = [];
        foreach ($data as $key => $value) {
            $data = [
                'task_id' => $id,
                'user_id' => $value
            ];
            $result = $this->model->create($data);
            if(!$result){
                $this->result(__('task.register.user.bad'), Response::HTTP_BAD_REQUEST, false);
            }
            $resultData[] = $value;
        }
        return $resultData;
    }

    public function UpdateUserTask($id,$data){
        $dataListUserOld = $this->model->where('task_id', $id)->pluck('user_id')->toArray();

        $arrayDiffSql = array_diff($dataListUserOld ?? [],$data ?? []);
        $arrayDiffNew = array_diff($data ?? [],$dataListUserOld ?? []);

        $dataListUserOld = $this->model->where('task_id', $id)->whereIn('user_id', $arrayDiffSql)->delete();
        $resultData = [];
        foreach ($arrayDiffNew as $key => $value) {
            $data = [
                'task_id' => $id,
                'user_id' => $value
            ];
            $result = $this->model->create($data);
            if(!$result){
                $this->result(__('task.update.user.bad'), Response::HTTP_BAD_REQUEST, false);
            }
            $resultData[] = $value;
        }
        return $resultData;
    }
}
