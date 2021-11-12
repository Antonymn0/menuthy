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
            'sub_menu_type' => ['required', 'string'],
            'menu_id' => ['required', 'integer'],
            'availability' => ['required', 'string'],
            'take_away' => [ 'integer'],
            'inhouse' => [ 'integer'],
            'available_days' => ['required', 'string'],
            'slang' => [ 'string'],
            'description' => [ 'string'],
            'image' => [ 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => ['string']
            ];
    }
}
