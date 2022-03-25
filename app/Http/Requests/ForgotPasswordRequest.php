<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Http\Requests\DefaultRequest;

class ForgotPasswordRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:' . DBSizes::STRING
        ];
    }
}
