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
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'plan_name' => is_null($this->payment_plan) ? 'Gratuito' : $this->payment_plan->name,
            'plan_period' => is_null($this->payment_plan) ? 'free' : $this->payment_plan->period,
            'isVerified' => !is_null($this->email_verified_at),
            'isBlocked' => $this->is_blocked,
            'isInactive' => false
        ]);
    }
}
