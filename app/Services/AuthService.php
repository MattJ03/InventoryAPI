<?php

namespace App\Services;
use App\Models\User;

class AuthService {

    public function register(array $credentials): ?string {
    
        $data = User::create([
          'name' => $credentials['name'],
          'email' => $credentials['email'],
          'password' => Hash::make($credentials['password'])
        ]);
    }

    public function login(array $credentials): ?string {

        $user = User::where('email', $credentials['email'])->first();

        if(!$user || !Hash::check($credentials['password'], $user->passoword)) {
            return null;
        }

        return $user->createToken('api_token')->plainTextToken;
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }
}