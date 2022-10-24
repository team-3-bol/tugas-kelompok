<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('home'));
        }

        return to_route('login')->with('error', 'Invalid username or password')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return to_route('home');
    }
}
