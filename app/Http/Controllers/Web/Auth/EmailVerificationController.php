<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Events\User\emailVerified;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UpdateUser;
use App\Models\User;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{


    
    public $trial_days = 15;   // set user trial period
    

    // verify user Email
    public function verifyEmail($email){

    //    $email =Validator::make($email,[   
    //         'email' => ['required', 'string', 'email', 'max:255'],            
    //     ]);        

        if($user = User::Where('email', $email)->first()) {
            $user->update([
                 'email_verified_at' => now(),
                 'registration_status'=> 'trial',
                 'registration_status'=> 'trial',
                 'trial_expiry'=> $this->trialDays($this->trial_days),
                 ]);
            event(new EmailVerified($user));
            return redirect()->intended('/dashboard')
            ->with(['success', 'Your email has been succesfully verified!']);
        } 
        return redirect()->back()
         ->with(['errors', 'Email not verified!']);   
    }


    //trial date function
    public function trialDays($days){

        return Carbon::now()->addDays($days);
    }
}
