<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);

        return $token
            ? response()->json(['message' => 'Login Successful!', 'token' => $token])
            : response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
