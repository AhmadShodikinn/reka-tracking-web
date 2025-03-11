<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ( !Auth::attempt($request->only('email', 'password')) ) {
            return response()->json([
                'message' => 'Unauthorized. email or password not found',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        $token = $user->createToken('auth_token')->plainTextToken;

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

    public function logout() {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success!',
        ]);
    }
    
}
