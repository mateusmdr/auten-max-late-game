<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return([
            'id' => $this->id,

            'email' => $this->email,
            'name' => $this->name,
            'identification_type' => $this->identification_type,
            'identification_value' => $this->identification_value,
            'phone' => $this->phone,
            'is_verified' => !!$this->is_verified,
            'verified_at' => $this->verified_at,
        ]);
    }
}
