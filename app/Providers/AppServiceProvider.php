<?php

namespace App\Providers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use MercadoPago\SDK;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	   if($this->app->environment('production')) {
    	       URL::forceScheme('https');
	   }
        DB::listen(function($query) {
            Log::channel('database')->info(
                $query->sql.' -- '.$query->time.'ms -- ',
                $query->bindings
            );
        });

        SDK::setAccessToken(env('MERCADO_PAGO_TOKEN', null));
    }
}
