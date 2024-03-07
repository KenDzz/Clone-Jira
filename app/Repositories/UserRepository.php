<?php

namespace App\Repositories;

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


    public function CreateUser($dataUser){
        $dataUser['password'] = Hash::make($dataUser['password']);
        return $this->model->create($dataUser);
    }

    public function GetUserNormal(){
        return $this->model->where('permission_id','!=', 1)->get();
    }
}
