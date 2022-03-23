<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class DefaultRequest extends FormRequest
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

    public function failedValidation(Validator $validator) {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()
                ->json(['errors' => $errors])
                ->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
                ->header('Content-Type', 'application/json')
        );
    }
}
