<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $hidden = ['password'];
    protected $guarded = ['is_admin'];
}
