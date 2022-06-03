<?php

namespace App\Http\Requests;

use App\Helpers\DBTypes;
use App\Http\Requests\BaseRequest;

class ChangePaymentPlanRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'period' => 'in:' . implode(',',DBTypes::PAYMENT_PERIODS),
            'method' => 'in:' . implode(',',DBTypes::PAYMENT_METHODS)
        ];
    }
}
