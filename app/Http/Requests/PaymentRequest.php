<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class PaymentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_token' => 'required|string|max:'. DBSizes::TOKEN,
            'cardholderName' => 'required|string|max:'. DBSizes::STRING,
            'identificationNumber' => 'required|cpf'
        ];
    }
}
