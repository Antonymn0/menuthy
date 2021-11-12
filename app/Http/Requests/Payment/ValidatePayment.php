<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidatePayment extends FormRequest
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
            'order_id' => ['required', 'integer'],
            'amount_due' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'amount_paid' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'discount_amount' => [ 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'status' => ['required', 'string'],
            'payment_method' => ['required', 'string'],
            'transaction_id' => ['required', 'string', Rule::unique('payments')->ignore($this->payment)],
            'customer_name' => ['required', 'string'],
            'transaction_date' => ['required', 'date'],
            'payee_account_number' => ['required', 'string'],
            'table_number' => [ 'integer'],
            'avatar' => ['string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
