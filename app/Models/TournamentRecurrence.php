<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class TournamentRecurrence extends Model
{
    // use Prunable;

    protected $fillable = [
        'schedule',
        'ends_at'
    ];

    // public function prunable()
    // {
    //     return static::whereDate('ends_at', '<=', today()->subDays(7));
    // }

    public function tournaments() {
        return $this->hasMany(Tournament::class);
    }
}
