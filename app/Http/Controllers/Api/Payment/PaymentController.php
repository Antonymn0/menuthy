<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Events\Payment\paymentCreated;
use App\Events\Payment\paymentUpdated;
use App\Events\Payment\paymentDestroyed;
use App\Http\Requests\Payment\ValidatePayment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of payments',
            'data'=>$payments], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidatePayment  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePayment $request)
    {
        $data = $request->validated();        
        $payment = Payment::create($data);
        event(new paymentCreated($payment));
        return response()->json([
            'success'=> true,
            'message'=> 'payment created successfuly',
            'data'=> true,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment= Payment::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single payment retrieved successfully', 
            'data'=>$payment], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidatePayment  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePayment $request, $id)
    {
        $data = $request->validated();
        $payments = Payment::findOrFail($id)->update($data);
        $payments = Payment::findOrFail($id);
        event(new paymentUpdated($payments));
        return response()->json([
            'success'=> true, 
            'message'=>'Payments updated successfuly', 
            'data'=>true],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id)->delete();
        event(new paymentDestroyed($payment));
        return response()->json([
            'success'=> true, 
            'message'=> 'Payment deleted successfuly', 
            'data'=>$payment], 200);
    }

    /**
     * Restore the specified resource back into storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( $id)
    {
        $payment = Payment::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'Payment restored successfully', 
            'data'=>$payment],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $payment = Payment::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new paymentDestroyed($payment)); 
        return response()->json([
            'success' => true,
            'message' => 'Payment parmanently deleted!',
            'data' => $payment
        ], 200);
    }
}
