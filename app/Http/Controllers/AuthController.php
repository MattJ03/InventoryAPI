<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {
        $user = $request->validate([
         'name' => 'required|min:2|max:10',
         'email' => 'required|email',
         'password' => 'required|confirmed|min:5|max:15',
        ]);

        User::create([
         'name' => $user->name,
         'email' => $user->email,
         'password' => \bcrypt($user->password),
        ]);
    }

    public function login(Request $request) {
        $user = $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:5|max:15',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials', 
            ], 401);
        }
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            ]);
        
    }

    public function logout(Request $request) {

    }
}
