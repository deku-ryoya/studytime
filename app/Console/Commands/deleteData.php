<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\User;
use App\Todo;

class deleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'データの削除';

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
        $day = Carbon::today('Asia/Tokyo');
        $todos = Todo::all();
        foreach($todos as $todo) {
            if($todo->created_at->lt($day)) {
                $todo->delete();
            };
        };
        
        $users = User::all();
        foreach($users as $user) {
            $user->fill(['today_time' => 0])->save();
        };
        
    }
}
