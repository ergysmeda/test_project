<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Create a token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    /**
     * Log in a user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Create a token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
