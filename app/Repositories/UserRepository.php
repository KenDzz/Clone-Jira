<?php

namespace App\Repositories;

use App\Enums\UserType;
use App\Http\Controllers\MailController;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{


    public function getModel()
    {
        return User::class;
    }


    public function createUser($dataUser){
        $dataUser['password'] = Hash::make($dataUser['password']);
        return $this->model->create($dataUser);
    }

    public function getUserNormal(){
        return $this->model->where('permission','!=', (string)UserType::Administrator)->get();
    }
}
