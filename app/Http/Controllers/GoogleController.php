<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleController
{
    public function callback(Request $request)
    {
        $response = Http::withHeaders(['Content-Type: application/x-www-form-urlencoded'])
            ->asForm()
            ->post('https://oauth2.googleapis.com/token', [
            'code' => $request->get('code'),
            'client_id' => config('oauth.google.client_id'),
            'client_secret' => config('oauth.google.client_secret'),
            'redirect_uri' => config('oauth.google.callback_uri'),
            'grant_type' => 'authorization_code',
        ]);

        $jwt = explode('.', $response['id_token']);
        $userinfo = json_decode(base64_decode($jwt[1]), true);

        $user = User::query()
            ->where('email', '=', $userinfo['email'])
            ->first();

        if ($user === null) {
            $user = User::create([
                'email' => $userinfo['email'],
                'password' => Hash::make(Str::random(8)),
                'first_name' => $userinfo['given_name'],
                'last_name' => $userinfo['family_name'],
            ]);
        }

        Auth::login($user);

        return back();
    }
}
