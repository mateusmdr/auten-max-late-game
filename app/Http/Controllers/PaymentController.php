<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use Exception;
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

    private function getErrorMessage($status) {
        switch ($status){
            case "cc_rejected_bad_filled_card_number":
                return'Ops! Algo deu errado: verifique o número do cartão e tente novamente.';
        
            case "cc_rejected_bad_filled_date":
                return'Ops! Algo deu errado: verifique a data de vencimento do cartão e tente novamente.';
                
            case "cc_rejected_bad_filled_other":
                return'Ops! Algo deu errado: revise os dados do cartão e tente novamente.';            

            case "cc_rejected_bad_filled_security_code":
                return'Ops! Algo deu errado: verifique o código de segurança do cartão e tente novamente.';    

            case "cc_rejected_blacklist":
                return'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
                
            case "cc_rejected_call_for_authorize":
                return'Ops! Algo deu errado: Você deve autorizar o uso do seu cartão junto à operadora.';            

            case "cc_rejected_card_disabled":
                return'Ops! Algo deu errado: Você deve ligar para a operadora do seu cartão para ativar seu cartão.';
        

            case "cc_rejected_card_error":
                return'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
        

            case "cc_rejected_duplicated_payment":
                return'Ops! Você já efetuou um pagamento com esse valor à poucos minutos. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.';
                
            case "cc_rejected_high_risk":
                return'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
                
            case "cc_rejected_insufficient_amount":
                return'Ops! Algo deu errado: parece que o seu cartão possui saldo insuficiente.';
        

            case "cc_rejected_max_attempts":
                return'Ops! Algo deu errado: Você atingiu o limite de tentativas permitido. Entre em contato com a operadora ou tente outra forma de pagamento.';
        

            default:
                return'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
        }
    }

    public function store(PaymentRequest $request)
    {
        $payment = new MercadoPagoPayment();

        $payment->token = $request->input('card_token');
        $name = $request->input('cardholderName');
        $cpf = $request->input('identificationNumber');

        $payment_plan = Auth::user()->payment_plan;
        if($payment_plan === null) {
            abort(422);
        }

        $payment->transaction_amount = $payment_plan->price;
        $payment->description = "Assinatura ". $payment_plan->name . " da plataforma MaxLateGame";
        $payment->installments = 1;
        $payment->notification_url = route('mercado_pago_webhook');
        // $payment->payment_method_id = Auth::user()->payment_method;

        $name = explode(" ", $name);
        $payment->payer = array(
            "email" => Auth::user()->email,
            "first_name" => $name[0],
            "last_name" => $name[array_key_last($name)],
            "identification" => array(
                "type" => "CPF",
                "number" => $cpf
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

        try{
            $payment->save();
        }catch(Exception $e) {
            return response()->json([
                'error' => $this->getErrorMessage($payment->status_detail)
            ], 422);
        }
        

        if($payment->error) {
            return response()->json([
                'error' => $this->getErrorMessage($payment->status_detail)
            ], 422);
        }

        $data = [
            "mercado_pago_id" => $payment->id,
            "user_id" => Auth::user()->id,
            "datetime" => now(),
            "status" => $payment->status,
            "payment_plan_id" => Auth::user()->payment_plan->id,
            "price" => Auth::user()->payment_plan->price,
            "payment_method" => Auth::user()->payment_method
        ];

        Payment::create($data);
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
