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
            'menu_item_type' => ['required', 'string'],
            'availability' => ['required', 'string'],
            'take_away' => ['required', 'integer'],
            'sub_menu_id' => ['required', 'integer'],
            'inhouse' => ['required', 'integer'],
            'price' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'discount' => [ 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'preperation_time' => ['required', 'string'],
            'available_days' => ['required', 'string'],
            'slang' => [ 'string'],
            'description' => [ 'string'],
            'image' => [ 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
