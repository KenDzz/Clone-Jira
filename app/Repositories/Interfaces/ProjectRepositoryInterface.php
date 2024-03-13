<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function CreateProject($dataProject);
    public function GetALLMultiProject($dataProject);
}
