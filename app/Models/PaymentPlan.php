<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{

    protected $fillable = [
        'price',
        'name',
        'period'
    ];

    public function getPeriodInDays() {
        switch($this->period) {
            case 'monthly':
                return 30;
            case 'biannual':
                return 180;
            case 'yearly':
                return 365;
            default:
                return 0;
        }
    }
}
