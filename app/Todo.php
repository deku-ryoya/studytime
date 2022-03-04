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
        'user_id',
    ];
    
    public function times()
    {
        return $this->hasMany('App\Time');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
