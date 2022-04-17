<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreUserRequest extends BaseRequest
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
            'cpf'=> 'required|cpf|unique:users,cpf',
            'phone'=> 'required|integer|digits_between:10,14',
        ];
    }
}
