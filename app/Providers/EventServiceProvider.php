<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

         // user events
        'App\Events\User\userCreated' => [
            //
        ],
        'App\Events\User\userUpdated' => [
            //
        ],
        'App\Events\User\userDestroyed' => [
            //
        ],

         // order events
        'App\Events\Order\orderCreated' => [
            //
        ],
        'App\Events\Order\orderUpdated' => [
            //
        ],
        'App\Events\Order\orderDestroyed' => [
            //
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
