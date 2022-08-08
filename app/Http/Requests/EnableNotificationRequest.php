<?php

namespace App\Http\Requests;

use App\Helpers\DBTypes;
use App\Rules\CronRule;
use Illuminate\Foundation\Http\FormRequest;

class EnableNotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'before' => 'required_if:after,0|required_without:after|boolean',
            'after' => 'required_if:after,0|required_without:before|boolean',
            'interval' => 'required_if:after,1|date_format:H:i',
            'option' => 'required|in:' . implode(',',DBTypes::NOTIFICATION_OPTIONS),
            'schedule' => [
                'required_if:option,custom',
                new CronRule()
            ]
        ];
    }
}
