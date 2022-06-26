<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payment as MercadoPagoPayment;

class Payment extends Model
{
    use Prunable;

    protected $guarded = [];

    public function prunable()
    {
        return static::where('status', 'pending')->whereDate('date_of_expiration', '<=', now())
            ->orWhere('status','cancelled')->where('payment_method', 'bolbradesco');
    }

    public function cancel() {
        if($this->status === 'pending' || $this->status === 'in_process') {
            $payment = MercadoPagoPayment::find_by_id($this->mercado_pago_id);
            if($payment !== null){
                $payment->status = "cancelled";
                $payment->update();
            }

            $this->status = "cancelled";
            $this->save();
        }else {
            Log::alert("Tentativa inválida de cancelar pagamento", $this);
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment_plan() {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function failed() {
        return in_array($this->status, ['rejected','cancelled', 'refunded', 'charged_back']);
    }

    public function is_pending() {
        return true;
    }
}
