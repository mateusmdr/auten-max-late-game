<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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

        $payment_method = $this->payment_method === 'bolbradesco' ? 'Boleto' : 'Cartão de Crédito';

        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'plan' => $this->payment_plan->name,
            'date' => $date,
            'time' => $time,
            'price' => 'R$ '. $this->price,
            'payment_method' => $payment_method,
            'is_pending' => !!$this->is_pending
        ];
    }
}
