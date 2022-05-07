<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class StoreAdRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required|string|max:' . DBSizes::STRING,
            'img' => 'required|mimes:png,jpg|max:' . DBSizes::IMG,
            'link_url' => 'required|url|max:'. DBSizes::STRING,
            'begin_at' => 'required|date_format:Y-m-d|after:yesterday',
            'end_at' => 'required|date_format:Y-m-d|after:begin_at',
            'price' => 'required|numeric|min:0'
        ];
    }
}
