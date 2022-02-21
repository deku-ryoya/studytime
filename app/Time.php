<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'id',
        'tasks_time',
        'Today_time',
        'Total_time',
        'user_id',
        'start_at',
        'stop_at',
        'todo_id',
    ];
    
    // protected $casts = [
    //     'start_at' => 'datetime',
    // ];
    
    public function todo()
    {
        return $this->belongsTo('App\Todo');
    }
}
