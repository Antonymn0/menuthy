<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class ValidateOrder extends FormRequest
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
        'menu_item_name' =>['required', 'string'],
        'menu_item_type' =>['required', 'string'],
        'menu_item_id' =>['required', 'integer'],
        'is_take_away' =>['required', 'integer'],
        'is_inhouse' =>['required', 'integer'],
        'price' =>['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'preperation_time' =>['required', 'string'],
        'state' =>['required', 'string'],
        'accompaniments' =>[ 'string'],
        // 'deleted_at' =>[ 'date'],
        'avatar' =>[ 'string']
        ];
    }
}
