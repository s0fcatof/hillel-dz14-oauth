<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::query()
            ->where('email', '=', $credentials['username'])
            ->first();

        if ($user === null) {
            $user = User::create([
                'email' => $credentials['username'],
                'password' => Hash::make($credentials['password'])
            ]);
        } else {
            if (Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
