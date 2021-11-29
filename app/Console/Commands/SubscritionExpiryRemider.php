<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Mail\SubscriptionExpiryReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscritionExpiryRemider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptionExpiry:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users about the expiry time of their subscription';

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
        $from = Carbon::now();
        $to = carbon::now()->addDays(25);

        $users =  DB::table('users')->whereBetween('registration_expiry', [$from, $to])->get();

        foreach($users as $user){
            Mail::to($user->email)->send(new SubscriptionExpiryReminder($user));
        }
    }
}
