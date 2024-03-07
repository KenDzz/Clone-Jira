<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'describes',
        'is_exist'
    ];

    public function UserProject()
    {
        return $this->hasMany(UserProject::class, 'project_id');
    }

    public function Task()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
