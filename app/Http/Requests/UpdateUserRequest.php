<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    // /**
    //  * Prepare the data for validation.
    //  *
    //  * @return void
    //  */
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'email' => Str::lower($this->email),
    //         'identification_type'=> Str::upper($this->identification_type),
    //         'identification_value'=> Str::replace('/[^0-9]*/g','',$this->identification_value),
    //         'phone'=> Str::replace('/[^0-9]*/g','',$this->phone)
    //     ]);
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user')->id;
        return [
            'email' => 'email|unique:users,email,' . $id . '|max:' . DBSizes::STRING,
            'name'=> 'string|min:2|max:' . DBSizes::STRING,
            'cpf'=> 'cpf|unique:users,cpf,' . $id,
            'phone'=> 'integer|digits_between:10,14',
            'is_blocked' => 'boolean',
            'blocked_reason' => 'required_if:is_blocked,1|string|max:' . DBSizes::STRING,
        ];
    }
}
