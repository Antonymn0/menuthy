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
        'menu_item_type' =>[ 'string'],
        'order_number' =>['required', 'integer'],
        'menu_item_id' =>['required', 'integer' ],
        'table_number' =>[ 'integer' ],
        'restaurant_id' =>['required', 'integer' ],
        'transaction_id' =>['required', 'string' ],
        'is_take_away' =>[ 'string'],
        'is_inhouse' =>[ 'string'],
        'order_type' =>['required', 'string'],
        'order_for' =>['required', 'integer'],
        'price' =>['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'preparation_time' =>['required', 'integer'],
        'status' =>['required', 'string'],
        'accompaniments' =>[ 'string'],
        'deleted_at' =>[ 'date'],
        'avatar' =>[ 'string']
        ];
    }
}
