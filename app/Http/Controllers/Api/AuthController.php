<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized. Email or password not found.',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // delete token existing if user already logged in
        $user->tokens()->delete();

        // generate token baru
        $token = $user->createToken('token')->plainTextToken;

        $user->load('role.division');

        return response()->json([
            'message' => 'Login Success!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'role' => [
                    'id' => $user->role->id,
                    'name' => $user->role->name,
                    'division' => [
                        'id' => $user->role->division->id,
                        'name' => $user->role->division->name,
                    ]
                ],
            ],
        ]);
    }

    // jaga-jaga kalau mau implementasi refresh token
    // public function refreshToken(Request $request) {
    //     $authHeader = $request->header('Authorization');

    //     if (empty($authHeader) || !str_starts_with($authHeader, 'Bearer ')) {
    //         return response()->json(['message' => 'Token is invalid'], 422);
    //     }

    //     $tokenString = explode('Bearer ', $authHeader)[1] ?? null;
    //     $token = PersonalAccessToken::findToken($tokenString);

    //     if (!$token || !$token->tokenable instanceof User) {
    //         return response()->json(['message' => 'Token is invalid'], 422);
    //     }

    //     // Hapus token lama & buat token baru
    //     $token->delete();
    //     $newToken = $token->tokenable->createToken('token')->plainTextToken;

    //     return response()->json([
    //         'status' => 'success',
    //         'access_token' => $newToken,
    //         'token_type' => 'Bearer',
    //     ]);
    // }

    public function logout() {
        Auth::user()->tokens()->delete();

       $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated.',
            ], 401);
        }

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Success!',
        ]);
    }
}
