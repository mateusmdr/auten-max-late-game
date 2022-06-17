<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Payment extends Model
{
    use Prunable;

    protected $guarded = [];

    public function prunable()
    {
        return static::where('status', 'pending')->where('payment_method', 'bolbradesco')->whereDate('date_of_expiration', '<=', now());
    }

    /**
     * Prepare the model for pruning.
     *
     * @return void
     */
    protected function pruning()
    {
        
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
