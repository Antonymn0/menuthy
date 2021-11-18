<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class ValidateMenuItem extends FormRequest
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
            'menu_item_name' => ['required', 'string'],
            'sub_menu_id' => ['required', 'integer'],
            'price' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'discount' => [ 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'preparation_time' => ['required', 'string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'menu_item_type' => [ 'string'],
            'availability' => ['string'],
            'take_away' => [ 'string'],
            'is_signiture' => ['string'],
            'is_new' => ['string'],
            'publish' => ['string'],
            'allergy_warning' => ['string'],
            'inhouse' => [ 'string'],
            'available_days' => [ 'string'],
            'slang' => [ 'string'],
            'description' => ['nullable'],
            'avatar' => [ 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
