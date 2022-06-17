<?php

namespace App\Models;

use DateTime;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'phone',
        'is_blocked',
        'block_reason',
        'email_verified_at',
        'payment_method',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isPastTestPeriod() {
        $verifiedAt = new DateTime($this->created_at);
        
        $days = now()->diff($verifiedAt)->format('%a');

        return($days >= env('TEST_PERIOD_DURATION', 14));
    }

    public function payment_plan() {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function isInactive() {
        $lastLogin = new DateTime($this->last_login);
        
        $days = now()->diff($lastLogin)->format('%a');

        return($days >= env('INACTIVE_USER_DAYS', 30));
    }

    public function isRegular() {
        return false;
        if(!$this->isPastTestPeriod()) {
            return true;
        }

        $builder = Payment::query();
        $builder->whereBelongsTo($this);
        $builder->whereNotIn('status', ['rejected','cancelled', 'refunded', 'charged_back']);
        $builder->latest('datetime');
        $payment = $builder->first();

        if($payment === null || $payment->payment_plan === null) {
            return false;
        }

        $payment_plan_period = $payment->payment_plan->getPeriodInDays();

        $days_from_now = now()->diff($payment->datetime)->format('%a');

        return($days_from_now <= $payment_plan_period);
    }
}
