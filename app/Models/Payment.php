<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'price',
        'payment_method',
        'is_pending',
        'user_id',
        'payment_plan_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment_plan() {
        return $this->belongsTo(PaymentPlan::class);
    }
}
