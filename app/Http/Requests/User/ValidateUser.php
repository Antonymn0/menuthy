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
            'user_name'=>['nullable','string','max:255'],
            'email'=>['required', 'string','max:255','email',  Rule::unique('users')->ignore($this->user)],
            'password' => ['required','min:4'],
            'package_type' => ['nullable','string'],
            'role' => ['required','string'],
            
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
            
            'password.required' => 'Please  enter your password',
            'password_again.required' => 'Please  enter your password again',
            'password_again.same' => 'Password does not match'
        ];
    }
}
