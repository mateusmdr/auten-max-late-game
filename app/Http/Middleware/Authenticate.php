<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function unauthenticated($request, array $guards)
    {
        return response()
        ->json(false)
        ->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED)
        ->header('Content-Type', 'application/json');
    }
}