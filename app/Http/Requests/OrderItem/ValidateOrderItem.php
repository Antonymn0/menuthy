<?php

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class ValidateOrderItem extends FormRequest
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
            'order_number' => ['required', 'integer'],
            'order_id' => ['required', 'integer'],
            'menu_item_id' => ['required', 'integer'],
            'item_name' => ['required', 'string'],
            'price_per_item' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'quantity' => ['required', 'integer'],
            'amount' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'preparation_time' => ['required', 'integer']
        ];
    }
}
