<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Undefined;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = (new DateTime($this->datetime))->format('d/m/Y');

        $time = (new DateTime($this->datetime))->format('H:i');
        $tournament = $this->tournament;

        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'date' => $date,
            'time' => $time,
            'type' => $this->type,
            'description' => is_null($tournament) ?  $this->description : null,
            'tournament' => is_null($tournament) ? null : [
                'name' => $tournament->name,
                'begin_at' => $tournament->subscription_begin_at,
                'end_at' => $tournament->subscription_begin_at,
            ]
        ];
    }
}
