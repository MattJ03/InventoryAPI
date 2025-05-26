<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register(array $credentials): ?string {
    
        $data = User::create([
          'name' => $credentials['name'],
          'email' => $credentials['email'],
          'password' => Hash::make($credentials['password'])
        ]);
        return $data;
    }

    public function login(array $credentials): ?string {

        $user = User::where('email', $credentials['email'])->first();

        if(!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        return $user->createToken('api_token')->plainTextToken;
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }
}