<?php

namespace App\Services;
use App\Models\User;

class AuthServie {

    public function register(array $credentials): ?string {
    
        $data = User::create([
          'name' => $credentials['name'],
          'email' => $credentials['email'],
          'password' => Hash::make($credentials['password'])
        ]);
    }

    public function login(array $credentials): ?string {

        $user = User::where()->only('email', $credentials['email'])->first();

        if(!$user || !Hash::check($credentials['password'], $user->passowrd)) {
            return null;
        }

        return $user->createToken('api_token')->plainTextToken;
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }
}