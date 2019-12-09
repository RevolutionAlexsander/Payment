<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddApplicationRequest extends FormRequest
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
            'type_account_id' => 'required|integer',
            'type_credit_id' => 'integer',
            'income' => 'required|numeric',
            'place_job' => 'required|string',
            'resident_address' => 'required|string',
        ];
    }
}
