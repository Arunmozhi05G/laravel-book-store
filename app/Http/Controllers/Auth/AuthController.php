<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Service\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        try {
            $login = $this->service->login($validated['email'], $validated['password']);

            if (!$login) {
                return redirect()->route('login')->with('status', 'Invalid credentials. Please try again.');
            }

            if ($login->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('status', 'Login successful.');
            }

            return redirect()->route('home')->with('status', 'Login successful.');
            
        } catch (Exception $e) {
            logger('Login Error: ' . $e);
            return redirect()->route('login')->with('status', 'Something went wrong. Please try again.');
        }
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $registered = $this->service->register($validated);

            if (!$registered) {
                return redirect()->route('register')->with('status', 'Something went wrong. Please try again.');
            }

            $this->service->login($validated['email'], $validated['password']);

            return redirect()->route('home')->with('status', 'Registration successful.');

        } catch (Exception $e) {
            logger('Login Error: ' . $e);
            return redirect()->route('register')->with('status', 'Something went wrong. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        $this->service->logout($request);
        return redirect()->route('home')->with('status', 'Logout successful.');
    }
}
