<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ✅ Correct namespace for User model
use Illuminate\Support\Facades\Auth; // ✅ Required for auth functions
use Tymon\JWTAuth\Facades\JWTAuth; // ✅ Required for JWT authentication

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user); // ✅ Use JWTAuth to generate token

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) { // ✅ Use Auth::attempt() correctly
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
