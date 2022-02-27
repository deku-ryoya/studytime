<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id',
        'body',
        'task_target_time',
        'tasks_time',
        'achievement_task',
    ];
    
    public function times()
    {
        return $this->hasMany('App\Time');
    }
}
