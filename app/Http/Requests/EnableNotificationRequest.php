<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnableNotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'before' => 'required_if:after,0|required_without:after|boolean',
            'after' => 'required_if:after,0|required_without:before|boolean',
            'interval' => 'required_if:after,1|integer|min:0',
        ];
    }
}
