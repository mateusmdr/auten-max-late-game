<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function getPaymentMethodName($method) {
        switch ($method) {
            case 'bolbradesco': return 'Boleto';
            case 'credit_card': return 'Cartão de Crédito';
            case 'pix': return 'Pix';
            case 'muchbetter': return 'MuchBetter';
        }
    }

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

        $payment_method = $this->getPaymentMethodName($this->payment_method);

        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'user' => new UserResource($this->user),
            'plan' => $this->payment_plan->name,
            'plan_period' => $this->payment_plan->period,
            'date' => $date,
            'time' => $time,
            'price' => 'R$ '. $this->price,
            'payment_method' => $payment_method,
            'is_pending' => $this->is_pending(),
            'has_failed' => $this->failed(),
            'status' => $this->status
        ];
    }
}
