<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRestaurant extends FormRequest
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
            'restaurant_name' => ['required', 'string'],
            'user_id' => ['required', 'integer'],
            'restaurant_type' => ['nullable', 'string'],
            'restaurant_id' => ['nullable', 'integer'],
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'currency' => ['nullable', 'string'],
            'address' => [ 'nullable', 'string'],
            'restaurant_phone_number' => ['nullable', 'string'],
            'restaurant_email' => ['nullable', 'string', 'email'],
            'is24/7' => ['nullable', 'integer'],
            'timezone' => ['nullable','string'],
            'website' => ['nullable','string'],
            'facebook' => ['nullable','string'],
            'twitter' => ['nullable','string'],
            'youtube' => ['nullable','string'],
            'instagram' => ['nullable','string'],
            'opening_hrs' => ['nullable', 'date'],
            'closing_hrs' => ['nullable', 'date'],
            'offer_accomodation' => [ 'nullable','integer'],
            'slang' => ['nullable', 'string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => ['nullable', 'string', 'nullable'],
            'avatar' => ['nullable', 'string'],
            
        ];
    }
}
