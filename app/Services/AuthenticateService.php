<?php

namespace App\Services;

use App\Models\User;

class AuthenticateService
{

    public function register($request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'timezone_id' => $request['timezone_id'],
            'password' => bcrypt($request['password']),
        ]);
    }
}
