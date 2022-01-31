<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('tasks/index')->with('todos',$todos);
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
