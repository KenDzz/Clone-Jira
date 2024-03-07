<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = "categorys";


    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    public function Task()
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
