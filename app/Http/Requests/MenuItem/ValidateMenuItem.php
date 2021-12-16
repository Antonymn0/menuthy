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
            'discount' => [ 'nullable', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'preparation_time' => ['required', 'string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'menu_item_type' => [ 'nullable', 'string'],
            'availability' => ['nullable', 'string'],
            'take_away' => [ 'nullable', 'string'],
            'ingredients' => [ 'nullable', 'string'],
            'is_signiture' => ['nullable', 'string'],
            'food_origin' => ['nullable', 'string'],
            'is_new' => ['nullable', 'string'],
            'is_hot' => ['nullable', 'string'],
            'is_veg' => ['nullable', 'string'],
            'is_halal' => ['nullable', 'string'],
            'carlories' => ['nullable', 'integer'],
            'publish' => ['nullable', 'string'],
            'allergy_warning' => ['nullable', 'string'],
            'inhouse' => [ 'nullable', 'string'],
            'available_days' => [ 'nullable', 'string'],
            'slang' => [ 'nullable', 'string'],
            'description' => ['nullable'],
            'avatar' => [ 'nullable', 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
