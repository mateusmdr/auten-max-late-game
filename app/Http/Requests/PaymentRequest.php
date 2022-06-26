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
            'is_ticket' => 'required|boolean',
            'card_token' => 'required_if:is_ticket,0|string|max:'. DBSizes::TOKEN,
            'cardholderName' => 'required_if:is_ticket,0|string|max:'. DBSizes::STRING,
            'identificationNumber' => 'required_if:is_ticket,0|cpf_cnpj'
        ];
    }
}
