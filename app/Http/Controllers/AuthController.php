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

        Auth::create([
         
        ]);
    }
}
