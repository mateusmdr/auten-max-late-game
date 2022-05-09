<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class StoreTournamentPlatformRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:'. DBSizes::STRING,
            'img' => 'required|mimes:png,jpg|max:' . DBSizes::IMG,
        ];
    }
}
