<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class ValidateTable extends FormRequest
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
            'table_number' => ['required', 'integer'],
            'table_name' => [ 'string'],
            'qr_code_link' => [ 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
