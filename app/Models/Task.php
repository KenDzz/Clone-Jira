<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'level_id',
        'name',
        'describes',
        'project_id',
        'priority',
        'start_time',
        'estimate_time',
        'comment_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function userTasks()
    {
        return $this->hasMany(UserTask::class, 'task_id');
    }

}
