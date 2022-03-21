<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        return [
            'email' => 'email|unique:users,email,' . $id . '|max:' . DBSizes::STRING,
            'name'=> 'string|min:2|max:' . DBSizes::STRING,
            'identification_type'=> 'in_array:' . DBTypes::IDENTIFICATION_TYPE,
            'identification_value'=> 'cpf',
            'phone'=> 'integer|digits_between:10,14',
        ];
    }
}
