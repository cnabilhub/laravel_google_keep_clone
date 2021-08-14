<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // Register page
    public function register()
    {
        if (Auth::check()) {
            // The user is logged in...
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    // Create user
    public function create(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required'],
        ]);
        $user['password'] = Hash::make($request->password);
        User::create($user);

        return redirect()->route('auth.login');
    }


    // Login page

    public function index()
    {

        if (Auth::check()) {
            // The user is logged in...
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    // Authenticate user
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    // Logout User
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}