<?php

namespace App\Repositories\Interfaces;

interface UserProjectRepositoryInterface  extends BaseRepositoryInterface
{
    public function createUserProject($id, $data);

    public function updateUserProject($id, $data);
    public function checkUserExitsInProject($userId, $projectId);

    public function getProjectsByUser($userId);

    public function deleteByProjectId($projectId);
}
