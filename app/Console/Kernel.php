<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('SendTrialExpiryNotification:TrialPeriodNotification')->daily()
                    ->appendOutputTo('scheduler.log');
        $schedule->command('subscriptionExpiry:reminder')->daily()
                    ->appendOutputTo('scheduler.log');
        $schedule->command('TrialPeriod:ended')->daily()
                    ->appendOutputTo('scheduler.log');
        $schedule->command('UnpaidStripeOrders:delete')->daily()
                    ->appendOutputTo('scheduler.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
