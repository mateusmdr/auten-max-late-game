<?php

namespace App\Http\Requests;

use App\Helpers\DBTypes;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'datetime' => 'date_format:Y-m-d H:i',
            'price' => 'numeric|min:0',
            'payment_plan' => 'in:' . implode(',', DBTypes::PAYMENT_PERIODS),
            'payment_method' => 'in:pix,muchbetter',
            'user_id' => 'integer|exists:users,id'
        ];
    }
}
