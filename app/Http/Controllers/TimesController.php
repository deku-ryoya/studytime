<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\Todo;
use App\User;
use App\Http\Requests\TodoRequest;
use Carbon\Carbon;
use Auth;

class TimesController extends Controller
{
    public function home()
    {
        return view('times/index');
    }

    public function dynamic(Todo $todo)
    {
        return view('/times/dynamic')->with(['todo' => $todo]);
    }
    
    public function statics(Todo $todo)
    {
        return view('/times/study')->with(['todo' => $todo]);
    }

    
    public function start(Time $time, Todo $todo)
    {
        $start = Carbon::now('Asia/Tokyo');
        
        $doesn_exists = Time::where('todo_id', $todo->id)->doesntExist();
        
        if ($doesn_exists) {
        }else {
            $time = Time::where('todo_id', $todo->id)->first();
        }
        
        $time->fill(['start_at' => $start, 'todo_id' => $todo->id])->save();
        return redirect('/times/' . $todo->id . '/study')->with(['todo' => $todo]);
    }
    
    
    public function stop(Time $time, Todo $todo, User $user)
    {
        $stop = Carbon::now('Asia/Tokyo');
        $time = Time::where('todo_id', $todo->id)->first();
        $task = $time->start_at;
        
        $user = User::where('id', Auth::id())->first();
        
        
        $task_times = explode(":",$task);
        
        $start = Carbon::createFromTime($task_times[0], $task_times[1], $task_times[2]);
        $task_time = $start->diffInSeconds($stop);
        $elapsed_time = $time->tasks_time += $task_time;
        
        // todosテーブルに挿入
        $todo = Todo::where('id', $todo->id)->first();
        $todo->fill(['tasks_time' => $elapsed_time])->save();
        $time->fill(['start_at' => null, 'stop_at' => null, 'tasks_time' => $elapsed_time])->save();
        
        //userごとのtotalを出す
        $total_time = $user->total_time + $task_time;
        $today_time = $user->today_time + $task_time;

        //usersテーブルに挿入
        $user->fill(['total_time' => $total_time, 'today_time' => $today_time])->save();

        return redirect('/times/' . $todo->id)->with(['todo' => $todo]);
    }
    
    
    public function store(Request $request, Time $time, Todo $todo)
    {
        $input = $request['time'];
        $start_at = time();
        $time->fill($start_at)->save();
        return redirect('/times/{todo}/study');
    }


    public function total(User $user)
    {
        $todos = Todo::where('user_id', Auth::id())->get();
        $user = User::where('id', Auth::id())->first();
        
        // userごとの本日のトータルを出す
        $total = 0;
        for($i = 0; $i < count($todos); $i++) {
            $total = $total + $todos[$i]->tasks_time;
        }
        
        return view('times/end')->with(['todos' => $todos, 'user' => $user, 'total' => $total]);
    }
    
    
    
}
