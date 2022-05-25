<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentRecurrence extends Model
{

    protected $fillable = [
        'schedule',
        'ends_at'
    ];

    public function tournaments() {
        return $this->hasMany(Tournament::class);
    }
}
