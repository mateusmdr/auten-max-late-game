<?php

use App\Mail\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('login',[AuthController::class, 'authenticate']);

Route::apiResource('/user',UserController::class);

Route::post('mail',function() {
    Mail::to('noreply@mlgpoker.com')
        ->send(new VerifyUser());
});