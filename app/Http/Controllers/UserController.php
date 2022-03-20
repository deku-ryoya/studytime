<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Todo;
use Auth;

class UserController extends Controller
{
    public function profile(User $user, Todo $todo)
    {
        $todo = Todo::where('user_id', Auth::id())->where('achievement_task', 1)->get();
        $achievement_count = count($todo);
        
        
        //自分の順位を出す
        $user1 = User::orderBy('total_time', 'desc')->get();
        $user = User::where('id', Auth::id())->first();
        $user_time = $user->total_time;
        $arr = [];

        for($i = 0; $i < count($user1); $i++) {
            $user = User::where('id', $i + 1)->first();
            $value = $user->total_time;
            array_push($arr, $value);
        }

        arsort($arr);
        $arr = array_values($arr);
        $result = array_search($user_time, $arr);
        $result = $result + 1;
        
        $user = User::where('id', Auth::id())->first();
        return view('users/profile')->with(['user' => $user, 'achievement_count' => $achievement_count, 'result' => $result]);
    }
    
    
    public function total_ranking(User $user)
    {
        
        $users = User::orderBy('total_time', 'desc')->take(5)->get();
        //自分の順位を出す
        $user1 = User::orderBy('total_time', 'desc')->get();
        $user = User::where('id', Auth::id())->first();
        $user_time = $user->total_time;
        $arr = [];

        for($i = 0; $i < count($user1); $i++) {
            $user = User::where('id', $i + 1)->first();
            $value = $user->total_time;
            array_push($arr, $value);
        }
        arsort($arr);
        $arr = array_values($arr);
        $result = array_search($user_time, $arr);
        $result = $result + 1;
        
        
        return view('users/total_ranking')->with(['users' => $users, 'result' => $result]);
    }
    
    
    public function today_ranking()
    {
        $users = User::orderBy('today_time', 'desc')->take(5)->get();
        
         //自分の順位を出す
        $user1 = User::orderBy('today_time', 'desc')->get();
        $user = User::where('id', Auth::id())->first();
        $user_time = $user->today_time;
        $arr = [];

        for($i = 0; $i < count($user1); $i++) {
            $user = User::where('id', $i + 1)->first();
            $value = $user->today_time;
            array_push($arr, $value);
        }
        arsort($arr);
        $arr = array_values($arr);
        $result = array_search($user_time, $arr);
        $result = $result + 1;
        
        return view('users/today_ranking')->with(['users' => $users, 'result' => $result]);
    }
}
