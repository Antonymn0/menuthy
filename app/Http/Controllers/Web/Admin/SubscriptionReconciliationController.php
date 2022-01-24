<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SubscriptionPayment;

class SubscriptionReconciliationController extends Controller
{
    public function viewAllSubscriptionPayments(){
        return Inertia::render('SuperAdmin/Reconciliation/SubscriptionReconciliation');
    }

/**
 * Get subscription payments to perform reconciliation on
 * @return response json
 */
    public function fetchReconciliations(){
        $payments = SubscriptionPayment::paginate(ENV('API_PAGINATION', 15));
            return response()->json([
                'success'=> true, 
                'message'=>'subscription payments fetched successfully', 
                'data'=>$payments],  200);
    }
}
