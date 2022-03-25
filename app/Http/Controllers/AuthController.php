<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
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

    public function logout() {
        Auth::logout();
    }

    public function forgotPassword(ForgotPasswordRequest $request) {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        dd($status);
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(ResetPasswordRequest $request) {
        
    }
}
