<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;

class TweetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tweet機能';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::orderBy('total_time', 'desc')->take(5)->get();
        $text = [];
        for ($i = 0; $i < 5; $i++) {
            $text[$i] =  $i+1 . '位　' . $users[$i]->name;
        }
        
        echo "ランキング" . PHP_EOL;
        for ($i = 0; $i < 5; $i++) {
            echo $text[$i] . PHP_EOL;
        }
        
        $twitter = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_secret'),
        );
        
        $twitter->post("statuses/update", [
            "status" => 
                'ランキング結果' . PHP_EOL .
                'こんにちは'
        ]);

    }
}
