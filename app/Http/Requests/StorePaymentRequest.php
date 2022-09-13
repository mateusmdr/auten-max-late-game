<?php

namespace App\Http\Requests;

use App\Helpers\DBTypes;

class StorePaymentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'datetime' => 'required|date_format:Y-m-d H:i',
            'price' => 'required|numeric|min:0',
            'payment_plan' => 'required|in:' . implode(',', DBTypes::PAYMENT_PERIODS),
            'payment_method' => 'required|in:pix,muchbetter'
        ];
    }
}
