<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Mail\TrialPeriodExpiryRemider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class trialPeriodExpireryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendTrialExpiryNotification:TrialPeriodNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification emails to users about their trial period';

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
        $users =  DB::table('users')->where('registration_status', 'trial')->get();

        foreach($users as $user){
            Mail::to($user->email)->send(new TrialPeriodExpiryRemider($user));
        }

        echo $users;
    }
}
