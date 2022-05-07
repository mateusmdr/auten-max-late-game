<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'description',
        'type',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
