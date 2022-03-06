<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class TwitterController extends Controller
{
    public function tweet(User $user)
    {
        
        $users = User::orderBy('total_time', 'desc')->take(5)->get();
        
        
        $twitter = new TwitterOAuth(
            'consumer_key',
            'consumer_secret',
            'access_token',
            'access_secret',
        );

        $text = "";
        foreach ($users as $user){
             $text .= $loop->iteration . '位 ' . $user->name . PHP_EOL;
        };
        dd($text);
        twitter->post("statuses/update", [
            "status" => 
                'ランキング結果' . PHP_EOL .
                '1位'
                // foreach ($users as $user){
                //     . $loop->iteration . ' ' . $user->name . PHP_EOL .
                // }
        ]);
        
    }
}
