<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [
        'is_approved'
    ];

    protected function tournament_type() {
        return $this->hasOne(TournamentType::class);
    }

    protected function tournament_platform() {
        return $this->hasOne(TournamentPlatform::class);
    }
}
