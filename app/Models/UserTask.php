<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;

    public $table = "user_task";

    protected $fillable = [
        'task_id',
        'user_id'
    ];

    public function Task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
