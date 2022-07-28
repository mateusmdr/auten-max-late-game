<?php

namespace App\Models;

use App\Models\TournamentRecurrence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Tournament extends Model
{
    use Prunable;

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $guarded = [];

    // Prune Tournaments older than 1 year from now
    public function prunable()
    {
        return static::whereDate('date', '<=', today()->subYear(1));
    }

    public function tournament_type() {
        return $this->belongsTo(TournamentType::class);
    }

    public function tournament_platform() {
        return $this->belongsTo(TournamentPlatform::class);
    }

    public function tournament_recurrence() {
        return $this->belongsTo(TournamentRecurrence::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
