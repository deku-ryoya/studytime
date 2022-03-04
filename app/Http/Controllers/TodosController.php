<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Time;
use App\Http\Requests\TodoRequest;
use App\User;
use Auth;

class TodosController extends Controller
{
    public function index(Todo $todo)
    {
        // $todo = Todo::where('user_id', Auth::id());
        // dd($todo);
        $todo = Todo::all();
        
        return view('tasks/index')->with('todos',$todo);
    }
    
    public function elapsedTime(Todo $todos)
    {
        $todos = Todo::where('user_id', Auth::id())->get();
        // dd($todos);
        // $todos = Todo::all();
        // dd($todos);
        return view('tasks/index')->with(['todos' => $todos]);
        // dd($elapsed_time);
        
    }
    
    public function endding(Todo $todo)
    {
        $todo = Todo::all();
        
         // userごとの本日のトータルを出す
        $todos = Todo::where('user_id', Auth::id())->get();
        $total = 0;
        for($i = 0; $i < count($todos); $i++) {
            $total = $total + $todos[$i]->tasks_time;
        }
        dd($total);
        
        return view('times/end')->with(['todo' => $todo, 'total' => $total]);
    }
    
    
    
    public function task_name(Todo $todo)
    {
        // $todo = Todo::all();
        return view('/times/study')->with(['todo' => $todo]);
    }  
    public function task_name2(Todo $todo)
    {
        // $todo = Todo::all();
        return view('/times/dynamic')->with(['todo' => $todo]);
    }
    
    public function store(Todo $todo, TodoRequest $request)
    {
        $input = $request['todo'];
        $input += ['user_id' => $request->user()->id];
        $todo->fill($input)->save();
        return redirect('/tasks')->with(['todo' => $todo]);
    }
    
    public function destroy(Todo $todo)
    {
        if($todo->achievement_task == 0){
            $todo->delete();
        }
        return redirect('/tasks')->with(['todo' => $todo]);
    }
    
    public function achieve(Todo $todo, User $user)
    {
        $todos = Todo::where('id', $todo->id)->first();
        $todo->fill(['achievement_task' => 1])->save();
        
        $user = User::where('id', Auth::id())->first();
        
        $task_count = $user->total_task + 1;
        $user->fill(['total_task' => $task_count])->save();
        
        return redirect('/tasks')->with(['todo' => $todo]);
    }
    
    
}
