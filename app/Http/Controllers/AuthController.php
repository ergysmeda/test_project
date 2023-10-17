<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\AuthenticateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;



class AuthController extends Controller
{

    public AuthenticateService $authenticateService;

    /**
     * @param AuthenticateService $authenticateService
     */
    public function __construct(AuthenticateService $authenticateService)
    {
        $this->authenticateService = $authenticateService;
    }


    /**
     * Register a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        // Validation
        $userRequest = $request->validated();

        $user = $this->authenticateService->register($userRequest);

        // Create a token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], Response::HTTP_OK);
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
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Create a token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
