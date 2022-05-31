<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PaymentResource;
use MercadoPago\Payment as MercadoPagoPayment;

class PaymentController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = Payment::query();
        $builder->with('user:id,name');
        $builder->with('payment_plan:id,name');

        return PaymentResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new MercadoPagoPayment();

        $payment->token = $request->input('card_token');
        return $payment->token;
        $payment_plan = Auth::user()->payment_plan;
        if($payment_plan === null) {
            abort(422);
        }

        $payment->transaction_amount = $payment_plan->price;
        $payment->token = $token;
        $payment->description = "Assinatura ". $payment_plan->name . " da plataforma MaxLateGame";
        $payment->installments = 1;
        $payment->notification_url = route('mercado_pago_webhook');
        $payment->payment_method_id = $payment_method_id;

        $name = explode(" ", Auth::user()->name);
        $payment->payer = array(
            "email" => Auth::user()->email,
            "first_name" => $name[0],
            "last_name" => $name[array_key_last($name)],
            "identification" => array(
                "type" => "CPF",
                "number" => Auth::user()->cpf
            ),
            //  "address"=>  array(
            //      "zip_code" => $cep,
            //      "street_name" => $endereco,
            //      "street_number" => $numero_endereco,
            //      "neighborhood" => $bairro,
            //      "city" => $cidade,
            //      "federal_unit" => $uf
            //   )
           );

        $payment->save();

        //$payment->id // salva isso no banco

        dd($payment->status);
        // payment->status pode ser "success", "in_proccess"
        // erro: $payment->error->message
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }
}
