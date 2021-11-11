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
            'restaurant_type' => ['required', 'string'],
            'user_id' => ['required', 'integer'],
            'country' => ['required', 'string'],
            'county' => ['required', 'string'],
            'city' => [ 'string'],
            'address' => [ 'string'],
            'restaurant_phone_number' => [ 'string'],
            'restaurant_email' => [ 'string'],
            'is24/7' => [ 'integer'],
            'opening_hrs' => [ 'date'],
            'closing_hrs' => [ 'date'],
            'offer_accomodation' => [ 'integer'],
            'slang' => [ 'string'],
            'description' => [ 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
