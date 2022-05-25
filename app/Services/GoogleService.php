<?php

namespace App\Services;

class GoogleService
{
    public static function link(): string
    {
        $parameters = [
            'client_id' => config('oauth.google.client_id'),
            'redirect_uri' => config('oauth.google.callback_uri'),
            'scope' => "openid profile email",
            'response_type' => "code"
        ];

        return "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($parameters);
    }
}
