<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class StoreBannerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'position' => 'required|integer|in:1,2,3,4,5',
            'img' => 'required|mimes:png,jpg,gif|max:' . DBSizes::IMG,
            'link_url' => 'required|url|max:'. DBSizes::STRING,
        ];
    }
}
