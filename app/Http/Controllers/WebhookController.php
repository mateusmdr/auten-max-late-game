<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function notify($request) {
        $mp = new MP(env('MERCADO_PAGO_TOKEN'));
        $payment_info = $mp->get_payment_info($_GET["id"]); // url params

        if($payment_info["response"]["collection"]["status"]=="approved") {
            // Altera pagamento correspondente
        }
    }
}
