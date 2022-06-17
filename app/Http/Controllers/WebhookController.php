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
            $mppayment = MPPayment::find_by_id($request->input($data)["id"]);
        }

        $payment = Payment::query()->where('mercadopago_id', $mppayment->id)->first();
        $user = User::query()->where('email', $mppayment->payer->email)->first();
        $payment_plan = PaymentPlan::query()->where('price', $mppayment->transaction_amount)->first();

        if($user === null) return;
        
        if($payment === null) {
            $data = [
                "mercado_pago_id" => $mppayment->id,
                "user_id" => $user->id,
                "datetime" => $mppayment->date_last_updated,
                "status" => $mppayment->status,
                "payment_plan_id" => $payment_plan->id,
                "price" => $mppayment->transaction_amount,
                "payment_method" =>$mppayment->payment_type_id
            ];
            Payment::create($data);

            return;
        }

        $payment->update($data = [
            "datetime" => $mppayment->date_last_updated,
            "status" => $mppayment->status,
        ]);

        $payment->save();
    }
}
