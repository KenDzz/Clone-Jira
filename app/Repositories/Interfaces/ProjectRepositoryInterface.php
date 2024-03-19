<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function createProject($dataProject);
    public function getAllByIds($dataProject);

    public function deleteProject($id);

    public function getAllIsExist();
}
