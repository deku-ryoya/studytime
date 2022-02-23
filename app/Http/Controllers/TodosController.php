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
        // $todo = \DB::table('todos')->first();
        // $elapsed_time = $todo->tasks_time;
        // // dd($elapsed_time);
        // if(!isset($elapsed_time)){
        //     return view('tasks/index',[
        //         'elapsed_times'=> 0,
        //     ]);
        // }elseif($elapsed_time >= 60){
        //     return view('tasks/index', [
        //         'elapsed_times' => $elapsed_time / 60,
        //     ]);
        // }else{
        //     $elapsed_times = 0;
        // }
        
        // dd($elapsed_times);
        
        return view('tasks/index')->with('todos',$todos);
    }
    
    public function elapsedTime(Todo $todos)
    {
        $todos = Todo::all();
        // dd($todos);
        
        
        // foreach ($todos as $todo){
        //     // $todo = \DB::table('todos')->first();
        //     // dd($todo);
        //     $elapsed_time = $todo->tasks_time;
        //     // dd($elapsed_time);
        //     if(!isset($elapsed_time)){
        //         return view('tasks/index',[
        //             'elapsed_times'=> 0,
        //         ])->with('todos',$todos);
        //     }elseif($elapsed_time >= 60){
        //         return view('tasks/index', [
        //             'elapsed_times' => $elapsed_time / 60,
        //         ])->with('todos',$todos);
        //     }else{
        //         return view ('tasks/index',[
        //             'elapsed_times' => 0,
        //         ])->with('todos',$todos);
        //     }
        // }
        
        
        
        
        // foreach ($todos as $todo){
        //     // $todo = \DB::table('todos')->first();
        //     $elapsed_time = $todo->tasks_time;
        //     dd($elapsed_time);
        // }
            // dd($elapsed_time);
            // dd($elapsed_time);
            // dd($todo);
            // dd($elapsed_time);
            
            // if(!isset($elapsed_time)){
            //     $elapsed_times = 0;
            // }elseif($elapsed_time >= 60){
            //     $elapsed_times = $elapsed_time / 60;
            // }elseif($elapsed_time){
                
            // }else{
            //     $elapsed_times = 0;
            // }
            
                // dd($elapsed_times);
            // @foreach ((array)$elapsed_time as $elapsedtime)
        
        // $todo = Todo::where('id', $todo->id)->first();
        
        // return view('tasks/index')->with('todos',$todos);
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
        return redirect('/tasks');
    }
    
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect('/tasks');
    }
    
}
