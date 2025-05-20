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

    }
   
}
