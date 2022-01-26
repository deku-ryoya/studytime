<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TImes;

class TimesController extends Controller
{
    public function index()
    {
        return view('times/study');
    }
    public function tasks()
    {
        return view('tasks/index');
    }
    public function endding()
    {
        return view('times/end');
    }
    
    
}
