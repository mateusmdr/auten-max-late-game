<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Helpers\DBTypes;

class StoreNotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'datetime' => 'required|date_format:Y-m-d H:i|after:yesterday',
            'message' => 'required|string|max:'.DBSizes::STRING,
            'type' => 'required|in:' . DBTypes::NOTIFICATION_TYPES .'|max:'.DBSizes::STRING,
            'user_id' => 'integer|exists:App\Models\User,id'
        ];
    }
}
