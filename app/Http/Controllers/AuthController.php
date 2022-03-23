<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(AuthRequest $request)
    {
        if(Auth::check()){
            Auth::logout();
        }

        $credentials = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return response()
                ->json(true)
                ->setStatusCode(JsonResponse::HTTP_OK)
                ->header('Content-Type', 'application/json');
        }
 
        return response()
            ->json(false)
            ->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED)
            ->header('Content-Type', 'application/json');
    }
}
