<?php

namespace App\Http\Controllers\Api\Banking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\User\stripeInfoUpdated;
use Inertia\Inertia;
use App\Models\User;
use Stripe\Stripe;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBankingPage()
    {
        return Inertia::render('Banking/Banking');
    }

    /**
     * Update stripe banking info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStripeInfo(Request $request)
    {       
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if(isset($user)){
            if(Hash::check($request->password, $user->password)){
                // validate stripe key
                $stripe= $this->validateStripeSecretKey($request);
                if(!$stripe){
                    return response()->json([
                        'success' => false,
                        'message' => 'Stripe secret key not valid!',
                        'data' => true,
                    ], 401) ; 
                }
                $user->update([
                    'stripe_publishable_key' => $request->stripe_publishable_key,
                    'stripe_secret_key' => $request->stripe_secret_key
                ]); 
                event(new stripeInfoUpdated($user));             
                return response()->json([
                    'success' => true,
                    'message' => 'Stripe info updated successfuly',
                    'data' => true,
                ], 200) ; 
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong Password!',
                    'data' => false,
                ], 403);
            }
            
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No account associated with the provided email.',
                'data' => false,
            ], 404); 
        }
        
    }

    /**
     * Validate stript secret key.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validateStripeSecretKey($request)
    {
        try {
             $apiKey = Stripe::setApiKey($request->stripe_secret_key);
            // create a test customer to see if the provided secret key is valid
            $response =  \Stripe\Customer::create(["description" => "Test Customer - Validate Secret Key"]); 
            return true;
            }       
        catch(\Stripe\Error\Authentication $e){
           return false;
        }
        catch(\Stripe\Error\ApiConnection $e){
          return false;
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
