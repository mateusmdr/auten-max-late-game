<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'position' => 'integer|in:1,2,3,4,5',
            'img' => 'mimes:png,jpg|max:' . DBSizes::IMG,
            'link_url' => 'url|max:'. DBSizes::STRING,
        ];
    }
}
