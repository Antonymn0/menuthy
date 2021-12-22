<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UpdateUser;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Events\User\SendEmailVerificationLink;
use App\Events\User\emailVerified;
use App\Mail\ConfirmEmail;
use App\Models\User;
use Carbon\Carbon;
use App\Events\User\userCreated;

class EmailVerificationController extends Controller
{
    
    public $trial_days = 15;   // set user trial period


    /**
    * Send user averifcation email
    *  @param $emial
    * @return response json
    */
    public function sendVerificationEmailLink($email){
        
        if(isset($email)){
            $user = User::where('email', $email)->first();
            if(isset($user)){
               event(new SendEmailVerificationLink($user));
                return response()->json([
                    'success' => true,
                    'message' => 'Verification email sent succsessfuly',
                    'data'=> true,
                ], 200);
            }
            else return response()->json(['success'=> false, 'message'=>'Email not registered'], 404);
        }
        else return response()->json(['success'=> false, 'message'=>'Email not set'], 500);
    }


    /*
     * Verify user email
     * @param $email
     * @return response json
     */
    public function verifyEmail($email){      

        if(isset($email)) {            
            $user = User::Where('email', $email)->first();
            if(isset($user)){
                if(isset($user->email_verified_at)){
                    return redirect()->intended('/dashboard')
                    ->with(['success', 'Your email has been succesfully verified!']);
                }
                $user->update([
                    'email_verified_at' => now(),
                    'registration_status'=> 'trial',
                    'trial_expiry'=> $this->trialDays($this->trial_days),
                    ]);
                event(new emailVerified($user));
                    return redirect()->intended('/dashboard')
                    ->with(['success', 'Your email has been succesfully verified!']);
            }            
        } 
        else return redirect()->back()
            ->with(['errors', 'Email not verified!']);   
    }


    //trial date function
    public function trialDays($days){

        return Carbon::now()->addDays($days);
    }
}
