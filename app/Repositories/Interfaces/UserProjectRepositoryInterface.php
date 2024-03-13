<?php

namespace App\Repositories\Interfaces;

interface UserProjectRepositoryInterface  extends BaseRepositoryInterface
{
    public function CreateUserProject($id, $data);

    public function UpdateUserProject($id, $data);
    public function checkUserExitsInProject($userId, $projectId);

    public function GetListProjectByUser($userId);
}
