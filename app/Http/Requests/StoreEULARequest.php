<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Http\Requests\BaseRequest;

class StoreEULARequest extends BaseRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:pdf|max:'. DBSizes::PDF
        ];
    }
}
