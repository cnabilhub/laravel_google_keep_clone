<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required'],
            'password' => ['required'],
            'img' => ['mimes:jpg,png', 'max:5048'],

        ]);

        $user['password'] = Hash::make($request->password);

        if ($request->img !== null) {
            $newImgName = time() . '-' . $request->name . '.' . $request->img->extension();
            $request->img->move(public_path('images/profiles'), $newImgName);
            $user['img_path'] = $newImgName;
        }

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

    // Register page
    public function settings()
    {
        return view('auth.settings');
    }

    public function updatesetting(Request $request)
    {


        $user = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],

        ]);


        if ($request->password !== null) {
            $user_exist = User::findOrfail(Auth::id());
            if ($user_exist) {

                if ($request->new_password == $request->re_password && Hash::check($request->password, $user_exist->password)) {

                    $user['password'] = Hash::make($request->new_password);
                } else {
                    return back()->with('error', 'Password dont match');
                }
            }
        }


        if ($request->img !== null) {

            $newImgName = time() . '-' . $request->name . '.' . $request->img->extension();
            $request->img->move(public_path('images/profiles'), $newImgName);
            File::delete(public_path('images/profiles/' . Auth::user()->img_path));
            $user['img_path'] = $newImgName;
        }

        User::where('id', Auth::id())->update($user);

        return redirect()->route('auth.settings')->with('message', 'updated successfuly  ;)');
    }
}