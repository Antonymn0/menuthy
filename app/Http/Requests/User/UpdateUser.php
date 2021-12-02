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
            'first_name'=>['required','max:255'],
            'middle_name'=>['nullable', 'string','max:255'],
            'last_name'=>['required','string','max:255'],
            'user_name'=>['nullable','string','max:255'],
            'email'=>['required', 'string','max:255','email',  Rule::unique('users')->ignore($this->user)],
            'phone'=>['nullable', 'string',  Rule::unique('users')->ignore($this->user)],
            'registration_status' => ['nullable','string'],
            'package_type' => ['nullable','date'],
            'trial_expiry' => ['nullable','date'],
            'registration_expiry' => ['nullable','date'],
            'address'=>['string','max:255','nullable'],
            'biography'=>['nullable','string', 'max:255'],            
            'dob'=> ['nullable','date'],
            'city'=> ['nullable','string', 'max:255'],           
            'country'=> ['nullable','string', 'max:255'],           
            'county'=> ['nullable','string', 'max:255'],           
            'location'=> ['nullable','string', 'max:255'], 
            'suspended_at'=> ['nullable','date'],
            'email_verified_at'=> ['nullable','date'],
            'gender'=> ['nullable','integer'],
            'tables'=> ['nullable','integer'],
            'nationality'=> ['nullable','string', 'max:255'],
            'suspended_by'=> ['nullable','integer'],
            'gender'=> ['nullable','integer'],
            'reg_status'=> ['nullable','integer'],
            'suspended_at'=> ['nullable','date'],
            'avatar'=> ['nullable','string', 'max:255'],
            'remember_token' => ['nullable','string'],
            'name'=> ['nullable','string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
