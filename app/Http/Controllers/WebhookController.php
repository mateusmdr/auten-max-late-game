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
        Log::info(var_export($request, true));
        if($request->input("type") === "payment") {
            $mppayment = MPPayment::find_by_id($request->input($data)["id"]);
        }

        $payment = Payment::query()->where('mercadopago_id', $mppayment->id)->first();
        $user = User::query()->where('email', $mppayment->payer->email)->first();
        $payment_plan = PaymentPlan::query()->where('price', $mppayment->transaction_amount)->first();

        if($user === null || $payment === null) return;

        $data = [
            "datetime" => $mppayment->date_last_updated,
            "status" => $mppayment->status,
        ];

        $payment->update($data);

        $payment->save();
    }
}
