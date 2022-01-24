<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionReconciliationController extends Controller
{
    public function viewAllSubscriptionPayments(){
        return Inertia::render('SuperAdmin/Reconciliation/SubscriptionReconciliation');
    }
}
