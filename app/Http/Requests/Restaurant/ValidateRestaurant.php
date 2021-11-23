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
            'restaurant_type' => [ 'string'],
            'restaurant_id' => ['integer'],
            'country' => [ 'string'],
            'city' => [ 'string'],
            'address' => [ 'string'],
            'restaurant_phone_number' => [ 'string'],
            'restaurant_email' => [ 'string', 'email'],
            'is24/7' => [ 'integer'],
            'timezone' => ['string'],
            'website' => ['string'],
            'facebook' => ['string'],
            'twitter' => ['string'],
            'youtube' => ['string'],
            'instagram' => ['string'],
            'opening_hrs' => [ 'date'],
            'closing_hrs' => [ 'date'],
            'offer_accomodation' => [ 'integer'],
            'slang' => [ 'string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => [ 'string'],
            'avatar' => [ 'string'],
            
        ];
    }
}
