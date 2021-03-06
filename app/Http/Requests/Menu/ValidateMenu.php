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
            'category' => [ 'string'],
            'restaurant_id' => ['required','integer'],
            'availability' => [ 'string'],
            'take_away' => [ 'integer'],
            'in_house' => [ 'integer'],
            'available_days' => [ 'string'],
            'slang' => [ 'string'],
            'published' => [ 'string'],
            'description' => [ ],
            'avatar' => [ 'string'],
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            // 'deleted_at' => [ 'date']
        ];
    }
}
