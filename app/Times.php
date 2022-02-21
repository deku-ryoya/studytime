<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $fillable = [
        'id',
        'Tasks_time',
        'Today_time',
        'Total_time',
        'User_id',
        'start_at',
        'stop_at',
        'todo_id',
    ];
}
