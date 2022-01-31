<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Times;

class TimesController extends Controller
{
    public function index()
    {
        return view('times/study');
    }
    
    public function endding()
    {
        return view('times/end');
    }
    
    public function store(Request $request, Times $times)
    {
        $input = ['Tasks_time' => 'elapsedTime'];
        $times->fill($input)->save();
    }
    
}
