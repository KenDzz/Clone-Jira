<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    public $table = "priority";

    protected $fillable = [
        'name'
    ];

    public function Task()
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
