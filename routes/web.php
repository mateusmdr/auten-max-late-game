<?php

use App\Models\PaymentPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PaymentPlanController;
use App\Http\Controllers\TournamentTypeController;
use App\Http\Controllers\TournamentPlatformController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $builder = PaymentPlan::query()->orderBy('price');
    return view('welcome', ['payment_plans' => $builder->get()]);
});

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {
    Route::get('/plataforma/{any?}', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->where('any','.*');

    Route::group(['prefix' => 'api'], function () {
        Route::apiResource('user',UserController::class);
        Route::apiResource('tournament',TournamentController::class);
        Route::apiResource('payment_plan', PaymentPlanController::class);
        Route::apiResource('tournament_platform',TournamentPlatformController::class);
        Route::apiResource('tournament_type',TournamentTypeController::class);
    });
});