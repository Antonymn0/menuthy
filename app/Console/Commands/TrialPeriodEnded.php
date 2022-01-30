<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Trial\trialEnded;
use App\Models\User;
use Carbon\Carbon;


class TrialPeriodEnded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TrialPeriod:Ended';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a notification to user that his trial period has ended today';

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
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            if($user->registration_status == 'trial'){
                // send trial expiry notification if trial ending today
                if($user->trial_expiry == Carbon::today()) event(new trialEnded($user));
            }
        }
        
    }

}
