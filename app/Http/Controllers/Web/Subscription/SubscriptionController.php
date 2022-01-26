<?php

namespace App\Http\Controllers\Web\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SubscriptionPayment;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubscriptionsPackagesPage()
    {
        
        $public_key = env('STRIPE_PUBLISHABLE_KEY');
        return Inertia::render('Subscriptions/SubscriptionsPage', ['stripe_public_key' => $public_key] );
    }

}
