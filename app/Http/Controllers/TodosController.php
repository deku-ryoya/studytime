<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Time;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function index(Todo $todos)
    {
        $todos = Todo::all();
        
        
        return view('tasks/index')->with('todos',$todos);
    }
    
    public function elapsedTime(Todo $todos)
    {
        $todos = Todo::all();
        return view('tasks/index')->with(['todos' => $todos]);
        // dd($elapsed_time);
        
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
        $todo->fill($input)->save();
        return redirect('/tasks')->with(['todo' => $todo]);
    }
    
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('/tasks'->with(['todo' => $todo]));
    }
    
    public function achieve(Todo $todo)
    {
        // $todo = Todo::find({{ $todo->id }});
        // $todo = Todo::all();
        // dd($todo[0]);
        // $b = $todo->id;
        // dd($b);
        // $todos = Todo::where('id', 3)->first();
        // dd($todos->id);
        // $a = $todo->id;
        // dd($a);
    
        $todo->fill(['achievement_task' => 1])->save();
        // dd($todos);
        // $achieve = Todo::where('achievement_task', true)->();
        // dd($achieve);
        // $a = $todo->achievement_task;
        // // dd($a);
        // $input = 1;
        // $todo->fill($input)->save();
        return redirect('/tasks');
    }
    
    
}
