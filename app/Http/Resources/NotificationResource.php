<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

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
        
        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'date' => $date,
            'time' => $time,
            'description' => $this->description
        ];
    }
}
