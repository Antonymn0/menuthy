<?php

namespace App\Http\Requests\SubMenu;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSubMenu extends FormRequest
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
            'sub_menu_name' => ['required', 'string'],
            'sub_menu_type' => [ 'string'],
            'menu_id' => ['required', 'integer'],
            'restaurant_id' => ['required', 'integer'],
            'availability' => ['string'],
            'is_new' => ['required','string'],
            'is_signiture' => ['string'],
            'publish' => ['required','string'],
            'take_away' => [ 'string'],
            'inhouse' => [ 'string'],
            'available_days' => [ 'string'],
            'slang' => [ 'string'],
            'description' => ['nullable'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'avatar' => [ 'string'],
            // 'deleted_at' => ['string']
            ];
    }
}
