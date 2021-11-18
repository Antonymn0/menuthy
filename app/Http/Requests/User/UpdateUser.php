<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name'=>['required','max:255'],
            'first_name'=>['string','max:255'],
            'middle_name'=>['string','max:255'],
            'last_name'=>['string','max:255'],
            'user_name'=>['string','max:255'],
            'email'=>['required', 'string','max:255','email',  Rule::unique('users')->ignore($this->user)],
            'phone'=>['required', 'string',  Rule::unique('users')->ignore($this->user)],
            'registration_status' => ['string'],
            'package_type' => ['date'],
            'trial_expiry' => ['date'],
            'registration_expiry' => ['date'],
            'address'=>['string','max:255'],
            'biography'=>['string', 'max:255'],            
            'dob'=> ['date'],
            'city'=> ['string', 'max:255'],           
            'country'=> ['string', 'max:255'],           
            'county'=> ['string', 'max:255'],           
            'location'=> ['string', 'max:255'], 
            'suspended_at'=> ['date'],
            'email_verified_at'=> ['date'],
            'gender'=> ['integer'],
            'nationality'=> ['string', 'max:255'],
            'suspended_by'=> ['integer'],
            'gender'=> ['integer'],
            'reg_status'=> ['integer'],
            'suspended_at'=> ['date'],
            'avatar'=> ['string', 'max:255'],
            'remember_token' => ['string'],
            'name'=> ['string']
        ];
    }
}
