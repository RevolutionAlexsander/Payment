<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAutoPaymentRequest extends FormRequest
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
            'api_token' => 'required',
            'number_account' => 'required',
            'sender_id' => 'required|integer',
            'transactions' => 'required|numeric',
            'type_autopayment_id' => 'required|integer',
        ];
    }
}
