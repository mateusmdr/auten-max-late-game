<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationIntervalRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'minutes' => 'required|integer|min:0|unique:App\Models\NotificationInterval,minutes'
        ];
    }
}
