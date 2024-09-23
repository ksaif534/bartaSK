<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationController
{
    /**
     * registration form
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Login form
     */
    public function createLogin()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created user registration resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|max:255',
        ]);
        $newUser = DB::table('users')->insert([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'created_at' => Carbon::now(),
        ]);

        return back()->with(['msg' => 'Registration has been completed successfully']);
    }

    /**
     * Authenticate login form data
     */
    public function storeLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        $user = DB::table('users')
            ->where('email', $validated['email'])
            ->first();
        if ($user) {
            if (filter_var($validated['email'], FILTER_VALIDATE_EMAIL)) {
                $credentials = [
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                ];
                $remember = ($request->has('remember') && $request->remember) ? true : false;
                if (Auth::attempt($credentials)) {
                    if ($remember) {
                        DB::table('users')->where('email', $user->email)
                            ->update([
                                'remember_token' => Hash::make(rand()),
                                'updated_at' => Carbon::now(),
                            ]);
                    } else {
                        DB::table('users')->where('email', $user->email)
                            ->update([
                                'updated_at' => Carbon::now(),
                            ]);
                    }

                    return redirect()->route('dashboard.index');
                } else {
                    return back()->with(['msg' => 'Wrong email or password']);
                }
            } else {
                return back()->with(['msg' => 'Email not valid']);
            }
        } else {
            return back()->with(['msg' => 'No User Found']);
        }
    }

    /**
     * Logut Functionality
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login.create');
    }
}
