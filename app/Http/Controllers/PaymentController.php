<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
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

    private function getErrorMessage($status) {
        switch ($status){
            case "cc_rejected_bad_filled_card_number":
                return 'Ops! Algo deu errado: verifique o número do cartão e tente novamente.';
        
            case "cc_rejected_bad_filled_date":
                return 'Ops! Algo deu errado: verifique a data de vencimento do cartão e tente novamente.';
                
            case "cc_rejected_bad_filled_other":
                return 'Ops! Algo deu errado: revise os dados do cartão e tente novamente.';            

            case "cc_rejected_bad_filled_security_code":
                return 'Ops! Algo deu errado: verifique o código de segurança do cartão e tente novamente.';    

            case "cc_rejected_blacklist":
                return 'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
                
            case "cc_rejected_call_for_authorize":
                return 'Ops! Algo deu errado: Você deve autorizar o uso do seu cartão junto à operadora.';            

            case "cc_rejected_card_disabled":
                return 'Ops! Algo deu errado: Você deve ligar para a operadora do seu cartão para ativar seu cartão.';

            case "cc_rejected_card_error":
                return 'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';

            case "cc_rejected_duplicated_payment":
                return 'Ops! Você já efetuou um pagamento com esse valor à poucos minutos. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.';
                
            case "cc_rejected_high_risk":
                return 'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.';
                
            case "cc_rejected_insufficient_amount":
                return 'Ops! Algo deu errado: parece que o seu cartão possui saldo insuficiente.';

            case "cc_rejected_max_attempts":
                return 'Ops! Algo deu errado: Você atingiu o limite de tentativas permitido. Entre em contato com a operadora ou tente outra forma de pagamento.';

            default:
                return 'Ops! Algo deu errado: não conseguimos processar o seu pagamento. Entre em contato com a operadora ou tente outra forma de pagamento.'
                    . ' Status do pagamento: ' . $status;
        }
    }

    public function store(PaymentRequest $request)
    {
        // DB::transaction(function() use ($request){
            // Must have selected both a plan and a payment_method
            $payment_plan = Auth::user()->payment_plan;
            $payment_method = Auth::user()->payment_method;
            if($payment_plan === null || $payment_method === null) {
                abort(422);
            }

            // Show latest ticket if existent
            if($payment_method === 'bolbradesco') {
                $lastTicket = Payment::query()->whereBelongsTo(Auth::user())->where('payment_method','bolbradesco')->where('payment_plan_id', $payment_plan->id)
                    ->where('status','pending')->whereDate('date_of_expiration', '>', now())->orderBy('datetime','desc')->first();
                if($lastTicket !== null) {
                    return response()->json([
                        'url' => $lastTicket->url
                    ]);
                }

                Payment::whereBelongsTo(Auth::user())->where('payment_method','bolbradesco')->where('status','pending')->get()->map->cancel();
            }
            
            //General payment data
            $payment = new MercadoPagoPayment();

            $payment->transaction_amount = $payment_plan->price;
            $payment->description = "Assinatura ". $payment_plan->name . " da plataforma MaxLateGame";
            $payment->installments = 1;
            $payment->notification_url = route('mercado_pago_webhook');

            // Method specific info
            if($payment_method === 'credit_card') {
                $payment->token = $request->input('card_token');
                $name = $request->input('cardholderName');
                $identificationNumber = $request->input('identificationNumber');
            }else {
                $name = Auth::user()->name;
                $identificationNumber = Auth::user()->cpf;
                $dateOfExpiration = now()->addDays(5);
                $payment->date_of_expiration = $dateOfExpiration->format(DateTime::RFC3339_EXTENDED);
                $payment->payment_method_id = $payment_method;
            }

            // Payer data
            $name = explode(" ", $name);
            $payment->payer = array(
                "email" => Auth::user()->email,
                "first_name" => $name[0],
                "last_name" => $name[array_key_last($name)],
                "identification" => array(
                    "type" => strlen($identificationNumber) <= 11 ? 'CPF' : 'CNPJ',
                    "number" => $identificationNumber
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

            //Treat failures
            try{
                $payment->save();
                if($payment->error) {
                    return response()->json([
                        'error' => $this->getErrorMessage($payment->status_detail),
                        'mp' => $payment->error
                    ], $payment->error->status);
                }
            }catch(Exception $e) {
                return response()->json([
                    'error' => $this->getErrorMessage($payment->status_detail)
                ], 422);
            }

            $data = [
                "mercado_pago_id" => $payment->id,
                "user_id" => Auth::user()->id,
                "datetime" => now(),
                "status" => $payment->status,
                "payment_plan_id" => $payment_plan->id,
                "price" => $payment_plan->price,
                "payment_method" => $payment_method,
                "url" => $payment_method === 'bolbradesco' ? $payment->transaction_details->external_resource_url : null,
                "date_of_expiration" => $payment_method === 'bolbradesco' ? $dateOfExpiration : null,
            ];

            Payment::create($data);

            if($payment_method === 'bolbradesco') {
                return response()->json([
                    'url' => $payment->transaction_details->external_resource_url
                ]);
            }else {
                // Cancel all pending tickets from that user
                Payment::whereBelongsTo(Auth::user())->where('payment_method','bolbradesco')->where('status','pending')->get()->map->cancel();

                if($payment->status !== 'approved') {
                    return response()->json([
                        'error' => $this->getErrorMessage($payment->status_detail)
                    ], 422);
                }
            }
        // });
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
