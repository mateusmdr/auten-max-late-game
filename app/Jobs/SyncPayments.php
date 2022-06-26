<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use MercadoPago\Payment as MPPayment;

class SyncPayments implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info("Job de sincronização de pagamentos iniciado");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pendingPayments = Payment::whereIn('status', ['pending', 'in_process'])->get();

        foreach ($pendingPayments as $payment) {
            $mppayment = MPPayment::find_by_id($payment->mercado_pago_id);
            if($mppayment === null) {
                Log::warning("Erro ao encontrar o pagamento de id " . $payment->mercado_pago_id . " na integração do MercadoPago");
            }

            $data = [
                "datetime" => $mppayment->date_last_updated,
                "status" => $mppayment->status,
            ];

            if($payment->status !== $mppayment->status) {
                Log::info(
                    "O pagamento de id ["
                    . $payment->id
                    . "] e mercado_pago_id ["
                    . $payment->mercado_pago_id
                    . "] mudou o status de ["
                    . $payment->status
                    . "] para ["
                    . $mppayment->status
                    . "]"
                );
                $payment->update($data);
                $payment->save();
            }
        }
    }
}
