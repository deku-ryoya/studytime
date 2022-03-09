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
        $twitter = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_secret'),
        );
        
        $total_users = User::orderBy('total_time', 'desc')->take(5)->get();
        $total_text = [];
        for ($i = 0; $i < 5; $i++) {
            $total_text[$i] =  $i+1 . '位　' . $total_users[$i]->name;
        }
        
        $today_users = User::orderBy('today_time', 'desc')->take(5)->get();
        $today_text = [];
        for ($i = 0; $i < 5; $i++) {
            $today_text[$i] =  $i+1 . '位　' . $today_users[$i]->name;
        }
        
        echo "ランキング" . PHP_EOL;
        for ($i = 0; $i < 5; $i++) {
            echo $total_text[$i] . PHP_EOL;
        }
        echo "ランキング" . PHP_EOL;
        for ($i = 0; $i < 5; $i++) {
            echo $today_text[$i] . PHP_EOL;
        }


        
        $twitter->post("statuses/update", [
            "status" => 
                'ランキング結果' . PHP_EOL .
                '総合ランキング' . PHP_EOL .
                $total_text[0] . PHP_EOL .
                $total_text[1] . PHP_EOL .
                $total_text[2] . PHP_EOL .
                $total_text[3] . PHP_EOL .
                $total_text[4] . PHP_EOL .
                '---------------' . PHP_EOL .
                '本日のランキング' . PHP_EOL .
                $today_text[0] . PHP_EOL .
                $today_text[1] . PHP_EOL .
                $today_text[2] . PHP_EOL .
                $today_text[3] . PHP_EOL .
                $today_text[4] . PHP_EOL 
        ]);

    }
}
