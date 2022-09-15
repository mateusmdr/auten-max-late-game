<?php

namespace App\Models;

use App\Models\TournamentRecurrence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Facades\Auth;

class Tournament extends Model
{
    use Prunable;

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $guarded = [];

    public function createNotification($data) {
        $notificationData = [
            'type' => 'tournament',
            'tournament_id' => $this->id,
            'user_id' => Auth::user()->id
        ];

        if($data['time'] ?? false) {
            $notificationData['datetime'] =
                Carbon::parse($this->date)->setTimeFrom($data['time']);
            $notificationData['description'] = (
                "As inscrições do torneio ". $this->name ." terminam às " .
                Carbon::parse($this->subscription_end_at)->format('H:i') .
                "."
            );

            Notification::create($notificationData);
        }

        if($data['before'] ?? false){
            $notificationData['datetime'] =
                Carbon::parse($this->date)->setTimeFrom($this->subscription_begin_at);
            $notificationData['description'] = "O torneio " . $this->name . " começou.";

            Notification::create($notificationData);
        }

        if($data['after'] ?? false) {
            $notificationData['datetime'] =
                Carbon::parse($this->date)
                    ->setTimeFrom(Carbon::parse($data['interval']));
            $notificationData['description'] = (
                "As inscrições do torneio ". $this->name ." terminam às " .
                Carbon::parse($this->subscription_end_at)->format('H:i') .
                "."
            );

            Notification::create($notificationData);
        }
    }

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
