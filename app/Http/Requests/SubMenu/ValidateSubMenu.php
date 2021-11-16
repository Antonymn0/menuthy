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
            'is_new' => ['integer'],
            'is_signiture' => ['integer'],
            'publish' => ['integer'],
            'take_away' => [ 'integer'],
            'inhouse' => [ 'integer'],
            'available_days' => [ 'string'],
            'slang' => [ 'string'],
            'description' => [ 'string'],
            'image' => [ 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => ['string']
            ];
    }
}
