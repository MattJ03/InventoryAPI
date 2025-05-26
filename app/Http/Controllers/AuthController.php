<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{

    public function register(AuthService $authService, Request $request) {
        $request->validate([
          'name' => 'required|string|min:3|max:20',
          'email' => 'required|email',
          'password' => 'required|min:5|max:30',
        ]);
         $credentials = $request->only('name', 'email', 'password');

        $authService->register($credentials);
        return response()->json(['success' => 'user registered']);
    }

    public function login(AuthService $authService, Request $request) {
        $credentials = $request->validate([
          'name' => 'required|string|min:3|max:20',
          'email' => 'required|email',
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

    public function logout(AuthService $authService, Request $request) {

        $authService->logout($request);
        return response()->json(['message' => 'User logged out']);

    }
}
