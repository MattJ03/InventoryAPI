<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Services\AuthService;

class AuthController extends Controller
{

    public function register(AuthSerice $authService, Request $request) {
        $request->validate([
          'name' => 'required|string|min:3|max:20',
          'email' => 'required|email',
          'password' => 'reuqied|min:5|max:30',
        ]);

        $authService->register($request);
        return response()->json(['success', 'user registered']);
    }

    public function login(AuthService $authService, Request $request) {
        $credentials = $request->validate([
          'name' => 'required|string|min:3|max:20',
          'email' => 'required|emal',
          'password' => 'required|min:5|max:30',
        ]);

        $token = $authService->login(credentials->only('email', 'password'));

        if(!token) {
            return response()->json(['Failed', 'Invalid credentials'], 401);
        } else {
            return response()->json([
                'access_token' => $token,
                'token_type' => "Bearer",
            ]);
        }
    }


   
}
