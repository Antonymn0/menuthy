<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateUser extends FormRequest
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
            'address'=>['string','max:255'],
            'biography'=>['string', 'max:255'],
            'password' => ['required','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/','max:255'],
            'password_again' => ['same:password'], 
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least one uppercase and one lowercase letters, one number and one special character',
            'full_name.required' => 'Please provide your full name',
            'email.required' => 'Please provide a valid email address',
            'phone.required' => 'Please provide your phone number',
            'password.required' => 'Please  enter your password',
            'password_again.required' => 'Please  enter your password again',
            'password_again.same' => 'Password does not match'
        ];
    }
}
