<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Rules\CronRule;

class StoreTournamentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:' . DBSizes::STRING,
            'prize' => 'required|integer|min:1',
            'min_buy_in' => 'integer|min:0',
            'max_buy_in' => 'integer|min:0|gte:min_buy_in',
            'date' => 'required|date_format:Y-m-d|after_or_equal:yesterday',
            'subscription_begin_at' => 'required|date_format:H:i',
            'subscription_end_at' => 'required|date_format:H:i',
            'tournament_platform_id' => 'required|integer|min:0|exists:App\Models\TournamentPlatform,id',
            'tournament_type_id' => 'required|integer|min:0|exists:App\Models\TournamentType,id',
            'is_recurrent' => 'required|boolean',
            'schedule' => [
                'required_if:is_recurrent,1',
                new CronRule()
            ],
            'ends_at' => 'required_if:is_recurrent,1|date_format:Y-m-d|after:date'
        ];
    }
}
