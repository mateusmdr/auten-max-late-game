<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Requests\DefaultRequest;

class StoreUserRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email|max:' . DBSizes::STRING,
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password|min:8',
            'name'=> 'required|string|min:2|max:' . DBSizes::STRING,
            'identification_type'=> [
                'required',
                Rule::in(DBTypes::IDENTIFICATION_TYPE)
            ],
            'identification_value'=> 'required|cpf|unique:users,identification_value',
            'phone'=> 'required|integer|digits_between:10,14',
        ];
    }
}
