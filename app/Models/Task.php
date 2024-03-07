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
        'priority_id',
        'start_time',
        'estimate_time'
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function Priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function UserTask()
    {
        return $this->hasMany(UserTask::class, 'task_id');
    }

}
