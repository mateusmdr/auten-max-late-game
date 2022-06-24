<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;

class UpdateTournamentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:' . DBSizes::STRING,
            'prize' => 'integer|min:1',
            'buy_in' => 'integer|min:0',
            'date' => 'date_format:Y-m-d|after:yesterday',
            'subscription_begin_at' => 'required_with:subscription_end_at,date_format:H:i',
            'subscription_end_at' => 'required_with:subscription_begin_at,date_format:H:i',
            'tournament_platform_id' => 'integer|min:0|exists:App\Models\TournamentPlatform,id',
            'tournament_type_id' => 'integer|min:0|exists:App\Models\TournamentType,id',
            'is_approved' => 'boolean',
        ];
    }
}
