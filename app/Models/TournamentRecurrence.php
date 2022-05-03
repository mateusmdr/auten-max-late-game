<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentRecurrence extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule',
        'ends_at'
    ];
}
