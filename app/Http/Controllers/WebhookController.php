<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payment as MPPayment;

class WebhookController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Payment::class);
    }

    public function notify(Request $request) {
        if($request->input("type") === "payment") {
            $mppayment = MPPayment::find_by_id($request->input('data')["id"]);
        }else {
            return Log::warning(
                "Notificação mercadopago de um tipo não suportado"
                . " do tipo ["
                . $request->input("type", "não providenciado")
                . "] com action ["
                . $request->input("action", "não providenciada")
                . "] objeto do request: "
                . var_export($request->all(), true)
            );
        }

        if($mppayment === null) {
            return response(null,404);
        }

        $payment = Payment::query()->where('mercado_pago_id', $request->input('data')["id"])->first();

        $data = [
            "datetime" => $mppayment->date_last_updated,
            "status" => $mppayment->status,
        ];

        if($payment === null) {
            return Log::warning(
                "Notificação mercadopago para um pagamento não existente"
                . " do tipo ["
                . $request->input("type", "não providenciado")
                . "] com action ["
                . $request->input("action", "não providenciada")
                . "] objeto do pagamento: "
                . var_export($mppayment, true)
                . " objeto do request: "
                . var_export($request->all(), true)
            );
        }else {
            Log::info(
                "Notificação mercadopago para o pagamento ["
                . $payment->id
                . "] do tipo ["
                . $request->input("type", "não providenciado")
                . "] com action ["
                . $request->input("action", "não providenciada")
                . "] mudou o status de ["
                . $payment->status
                . "] para ["
                . $mppayment->status
                . "]"
            );
        }

        $payment->update($data);

        $payment->save();
    }
}
