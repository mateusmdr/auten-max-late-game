<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Notification extends Model
{
    use Prunable;

    protected $guarded = [];

    // Prune Notifications older than 15 days from now
    public function prunable()
    {
        return static::whereDate('datetime', '<=', today()->subDays(15));
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }
}
