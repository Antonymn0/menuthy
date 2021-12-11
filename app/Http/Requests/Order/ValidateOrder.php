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
            'restaurant_id' => ['required','integer'],
            'transaction_id' => ['nullable','string'],
            'order_number' => ['required','string'],       
            'amount' => ['required','regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'paid' => ['required','string'],
            'amount_paid' => ['nullable','regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'time_paid' => ['nullable','date'],
            'number_of_items' => ['required','integer'],
            'status' => ['required','string'],
            'order_type' => ['required','string'],
            'table_number' => ['required','integer'],
        ];
    }
}
