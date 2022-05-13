<?php

namespace App\Models;

use App\Models\TournamentRecurrence;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $guarded = [];

    public function tournament_type() {
        return $this->belongsTo(TournamentType::class);
    }

    public function tournament_platform() {
        return $this->belongsTo(TournamentPlatform::class);
    }

    public function tournament_recurrence() {
        return $this->belongsTo(TournamentRecurrence::class);
    }
}
