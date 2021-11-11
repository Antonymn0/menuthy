<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class ValidateMenu extends FormRequest
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
            'menu_name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'restaurant_id' => ['required', 'integer'],
            'availability' => ['required', 'string'],
            'take_away' => ['required', 'integer'],
            'in_house' => ['required', 'integer'],
            'available_days' => [ 'string'],
            'slang' => [ 'string'],
            'description' => [ 'string'],
            'avatar' => [ 'string']
            // 'deleted_at' => [ 'date']
        ];
    }
}
