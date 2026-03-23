<?php

namespace App\Service;

use App\Models\User;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function login($email, $password)
    {
        auth()->attempt(['email' => $email, 'password' => $password]);

        if (!auth()->check()) {
            return false;
        }

        return auth()->user();
    }

    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 2,
            'phone_number' => $data['phone']
        ]);

        return $user;
    }

    public function logout($request)
    {
        auth()->logout();
        $request->session()->invalidate(); // destroy session
        $request->session()->regenerateToken(); // prevent CSRF issues

        return true;
    }
}
