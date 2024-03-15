<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function createProject($dataProject);
    public function getALLMultiProject($dataProject);
}
