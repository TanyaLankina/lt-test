<?php

namespace App\Services;

class AuthService
{
    public function getAccessToken($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password
        ];
        if (auth()->attempt($data)) {
            return auth()->user()->createToken('LaravelPassportRestApi')->accessToken;
        }
        return false;
    }
}
