<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class UpdateAdRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'string|max:' . DBSizes::STRING,
            'img' => 'mimes:png,jpg|max:' . DBSizes::IMG,
            'link_url' => 'url|max:'. DBSizes::STRING,
            'begin_at' => 'date_format:Y-m-d|after:yesterday',
            'end_at' => 'date_format:Y-m-d|after:begin_at',
            'price' => 'numeric|min:0'
        ];
    }
}
