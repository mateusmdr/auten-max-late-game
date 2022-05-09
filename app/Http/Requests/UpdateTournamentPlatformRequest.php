<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class UpdateTournamentPlatformRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:'. DBSizes::STRING,
            'img' => 'mimes:png,jpg|max:' . DBSizes::IMG,
        ];
    }
}
