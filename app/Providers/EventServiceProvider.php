<?php

namespace App\Providers;


use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    public function register() {
   parent::register();
}

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
        \App\Events\User\userCreated::class => [
            \App\Listeners\User\userCreatedListener::class,
        ],
        'App\Events\User\userUpdated' => [
            //
        ],
        'App\Events\User\userDestroyed' => [
            //
        ],

         // send email verification event
        'App\Events\User\SendEmailVerificationLink' => [
            'App\Listeners\User\SendEmailVerificationLinkListener'
        ],
         // email verified event events
        'App\Events\User\emailVerified' => [
            'App\Listeners\User\emailVerifiedListener'
        ],
         // stripe subscription webhook event
        'App\Events\StripeWebhooks\SubscriptionPaymentWebhook' => [
            'App\Listeners\StripeWebhooks\SubscriptionPaymentWebhookListener'
        ],
         // stripe order payment webhook event
        'App\Events\StripeWebhooks\OrderPaymentWebhook' => [
            'App\Listeners\StripeWebhooks\OrderPaymentWebhookListener'
        ],
         // stripe info updated event
        'App\Events\User\stripeInfoUpdated' => [
            'App\Listeners\User\stripeInfoUpdatedListener'
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

         // orderItem events
        'App\Events\OrderItem\orderItemCreated' => [
            //
        ],
        'App\Events\OrderItem\orderItemUpdated' => [
            //
        ],
        'App\Events\OrderItem\orderItemDestroyed' => [
            //
        ],

         // Qrcode events
        'App\Events\QrCode\qrCodeCreated' => [
            //
        ],
        'App\Events\QrCode\qrCodeUpdated' => [
            //
        ],
        'App\Events\QrCode\qrCodeDestroyed' => [
            //
        ],

         // Restaurant events
        'App\Events\Restaurant\restaurantCreated' => [
            //
        ],
        'App\Events\Restaurant\restaurantUpdated' => [
            //
        ],
        'App\Events\Restaurant\restaurantDestroyed' => [
            //
        ],

         // Menu events
        'App\Events\Menu\menuCreated' => [
            //
        ],
        'App\Events\Menu\menuUpdated' => [
            //
        ],
        'App\Events\Menu\menuDestroyed' => [
            //
        ],

         // Table events
        'App\Events\Table\tableCreated' => [
            //
        ],
        'App\Events\Table\tableUpdated' => [
            //
        ],
        'App\Events\Table\tableDestroyed' => [
            //
        ],

         // MenuItem events
        'App\Events\MenuItem\menuItemCreated' => [
            //
        ],
        'App\Events\MenuItem\menuItemUpdated' => [
            //
        ],
        'App\Events\MenuItem\menuItemDestroyed' => [
            //
        ],

         // SubMenu events
        'App\Events\SubMenu\subMenuCreated' => [
            //
        ],
        'App\Events\SubMenu\subMenuUpdated' => [
            //
        ],
        'App\Events\SubMenu\subMenuDestroyed' => [
            //
        ],

         // Payment events
        'App\Events\Payment\paymentCreated' => [
            
        ],        
        'App\Events\Payment\paymentUpdated' => [
            //
        ],
        'App\Events\Payment\paymentDestroyed' => [
            //
        ],

         // Subscription events
        'App\Events\Subscription\SubscriptionCreated' => [
            'App\Listeners\Subscription\SubscriptionCreatedListener'
        ],
        'App\Events\Subscription\SubscriptionFailed' => [
            'App\Listeners\Subscription\SubscriptionFailedListener'
        ],
        'App\Events\Subscription\SubscriptionUpdated' => [
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
