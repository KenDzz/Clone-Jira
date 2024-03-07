<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMedia extends Model
{
    use HasFactory;

    public $table = "task_media";

    protected $fillable = [
        'task_id',
        'url',
        'type'
    ];
}
