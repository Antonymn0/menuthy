<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SubscriptionPayment;
use App\Models\User;
use Carbon\carbon;

class SubscriptionReconciliationController extends Controller
{
    /**
     * Fetch all subscription payments
     * @return response
     */
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

    /**
     * Search user account by email to reconcile
     * @param $email
     * @return response
     */
    public function getUserAccount($email){
        $user = User::where('email', $email)->first();      
        return response()->json([
            'success'=> true, 
            'message'=>'subscription payments fetched successfully', 
            'data'=>$user],  200);
    }

    /**
    * Reconcile payment with associated user acc
    * @param $email $user
    */
    public function reconcilePayment($user_id, $payment_id){
        $user = User::findOrFail($user_id);
        $payment = SubscriptionPayment::findOrFail($payment_id);
        // if payment has been reconciled before return
        if($payment->reconciled){
           return response()->json([
            'success'=> false, 
            'message'=>'Payment has already been reconciled!', 
            'data'=>false],  403);
        } 

        $user->update([
            'package_type' => $payment->package_type,
            'package_period' => $payment->package_period,
            'registation_date' => $payment->registration_date,
            'registation_expiry' => $payment->registration_expiry,
        ]);
        $payment->update([
            'reconciled' => 'true',
            'reconciled_to' => $user->email,
            'reconciled_at' => Carbon::today(),
        ]);
        return response()->json([
            'success'=> true, 
            'message'=>'Payment reconciled successfuly', 
            'data'=>true],  200);

    }

    /**
     * Search payment by email
     */
    public function searchPayment($email){
        $payment = SubscriptionPayment::where('email', $email)->get();
         return response()->json([
            'success'=> true, 
            'message'=>'subscription payments fetched successfuly', 
            'data'=>$payment],  200);

    }
}
