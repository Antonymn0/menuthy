<?php

namespace App\Http\Requests\QrCode;

use Illuminate\Foundation\Http\FormRequest;

class ValidateQrCode extends FormRequest
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
            'table_id' => ['required', 'integer'],
            'qr_code_img' => ['required', 'string'],
            'qr_code_target_link' => ['required', 'string'],
            'avatar' => [ 'string'],
            // 'deleted_at' => [ 'date']
        ];
    }
}
