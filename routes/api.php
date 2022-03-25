<?php

use App\Mail\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//Authentication routes

Route::prefix('auth')->group(function () {
    //Public routes
    Route::middleware('guest')->group(function () {
        Route::post('login',[AuthController::class, 'login']);
        Route::post('forgot-password',[AuthController::class,'forgotPassword'])->name('password.email');
        Route::post('reset-password/{token}',[AuthController::class,'resetPassword'])->name('password.reset');
    });

    //Authenticated routes
    Route::middleware('auth')->group(function() {
        Route::post('logout',[AuthController::class, 'logout']);
    });
});



//Available Resources
Route::apiResource('/user',UserController::class);

// Route::post('mail',function() {
//     Mail::to('noreply@mlgpoker.com')
//         ->send(new VerifyUser());
// });