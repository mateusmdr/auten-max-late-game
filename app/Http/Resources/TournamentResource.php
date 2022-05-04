<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = (new DateTime($this->date))->format('d/m/Y');

        $subscription_begin = (new DateTime($this->subscription_begin_at))->format('H:i');
        $subscription_end = (new DateTime($this->subscription_end_at))->format('H:i');
        $subscription = $subscription_begin . ' às ' . $subscription_end;

        return [
            'name' => $this->name,
            'date' => $date,
            'subscription' => $subscription,
            'platform' => $this->tournament_platform->name,
            'type' => $this->tournament_type->name,
            'min' => $this->min_buy_in,
            'max' => $this->max_buy_in,
            'prize' => $this->prize,
            'isRecurrent' => !is_null($this->tournament_recurrence_id),
            'isApproved' => $this->is_approved
        ];
    }
}