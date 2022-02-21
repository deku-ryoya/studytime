<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\Todo;
use App\Http\Requests\TodoRequest;
use Carbon\Carbon;

class TimesController extends Controller
{
    public function index()
    {
        return view('times/study');
    }
    
    public function dynamic(Todo $todo)
    {
        // $start_at = Carbon::now();
        // $time->fill($start_at)->save();
        return view('/times/dynamic')->with(['todo' => $todo]);
    }
    
    public function staticc(Todo $todo)
    {
        return view('/times/study')->with(['todo' => $todo]);
    }
    
    public function endding()
    {
        return view('times/end');
    }
    
    public function start(Time $time, Todo $todo)
    {
        $start = Carbon::now('Asia/Tokyo');
        // dd($start);
        // $start += ['todo_id' => $todo->id];
        
        $doesn_exists = Time::where('todo_id', $todo->id)->doesntExist();
        
        if ($doesn_exists) {
        }else {
            $time = Time::where('todo_id', $todo->id)->first();
        }
        
        $time->fill(['start_at' => $start, 'todo_id' => $todo->id])->save();
        return redirect('/times/' . $todo->id . '/study')->with(['todo' => $todo]);
    }
    
    public function stop(Time $time, Todo $todo)
    {
        $stop = Carbon::now('Asia/Tokyo');
        // dd($stop);
        $time = Time::where('todo_id', $todo->id)->first();
        
        $task = $time->start_at;
        
        $task_times = explode(":",$task);
        
        $start = Carbon::createFromTime($task_times[0], $task_times[1], $task_times[2]);
        $task_time = $start->diffInSeconds($stop);
        $elapsed_time = $time->tasks_time += $task_time;
        
        
        // todosテーブルに挿入
        $todo = Todo::where('id', $todo->id)->first();
        $todo->fill(['tasks_time' => $elapsed_time])->save();
        
        $time->fill(['start_at' => null, 'stop_at' => null, 'tasks_time' => $elapsed_time])->save();
        
        
        // $time->fill(['tasks_time' => $task_time])->save();
        return redirect('/times/' . $todo->id)->with(['todo' => $todo]);
    }
    
    
    public function store(Request $request, Time $time, Todo $todo)
    {
        $input = $request['time'];
        $start_at = time();
        // $input = ['Tasks_time' => 'elapsedTime'];
        $time->fill($start_at)->save();
        return redirect('/times/{todo}/study');
    }
    
    
    
}
