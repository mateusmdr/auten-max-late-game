<?php

namespace App\Http\Requests;

use App\Helpers\DBSizes;
use App\Rules\CronRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:' . DBSizes::STRING,
            'prize' => 'required|numeric',
            'min_buy_in' => 'required|integer|min:0',
            'max_buy_in' => 'required|integer|min:0|gte:min_but_in',
            'date' => 'required|date_format:m/d/Y',
            'subscription_begin_at' => 'required|date_format:H:i',
            'subscription_end_at' => 'required|date_format:H:i|after:subscription_begin_at',
            'tournament_platform_id' => 'required|integer|min:0|exists:App\Models\TournamentPlatform,id',
            'tournament_type_id' => 'required|integer|min:0|exists:App\Models\TournamentType,id',
            'is_recurrent' => 'required|boolean',
            'recurrence_schedule' => [
                'required_if:is_recurrent,1',
                new CronRule()
            ],
            'ends_at' => 'required_if:is_recurrent,1|date_format:m/d/Y|after:date'
        ];
    }
}
