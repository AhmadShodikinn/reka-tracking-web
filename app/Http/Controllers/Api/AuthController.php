<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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

        $expiresAt = Carbon::now()->addSeconds(59);
        // $expiresAt = Carbon::now()->addMinutes(10);

        $token = $user->createToken('token')->plainTextToken;

        $latestToken = $user->tokens()->latest()->first();  // Ambil token terakhir yang dibuat

        // Update waktu kedaluwarsa pada token
        $latestToken->update([
            'expires_at' => $expiresAt
        ]);

        // $token->tokens->last()->update([
        //     'expires_at' => $expiration,
        // ]);

        $user->load('role.division');

        return response()->json([
            'message' => 'Login Success!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expiresAt,
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

    public function refreshToken(Request $request) {
        $token = $request->header('Authorization');
    
        if (empty($token)) {
            return response()->json(['message' => 'Token is invalid'], 422);
        }
    
        // Memecah Bearer token
        $token = explode('Bearer ', $token);
        if (empty($token[1]) || empty($token = PersonalAccessToken::findToken($token[1]))) {
            return response()->json(['message' => 'Token is invalid'], 422);
        }
    
        // Memeriksa apakah token terkait dengan model User
        if (!$token->tokenable instanceof User) {
            return response()->json(['message' => 'Token is invalid'], 422);
        }
    
        // Cek apakah token sudah kadaluarsa (jika kamu menyimpan expires_at)
        if (Carbon::now()->gt($token->expires_at)) {   
            $token->delete(); 
            $newToken = $token->tokenable->createToken('token')->plainTextToken;
        } else {
            return response()->json([
                'status' => 'token masih belum kadaluwarsa',
            ]);
        }

    return response()->json([
        'status' => 'success',
        'data' => [
            'access_token' => $newToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::now()->addMinutes(60), // set waktu kedaluwarsa token baru
        ]
    ]);
    }

    //experimental
    // public function refreshToken(Request $request) {
    //     $user = $request->user();
    //     $user->tokens->delete();
    //     $token = $user->createToken('token')->plainTextToken;
    
    //     return response()->json([
    //         'message' => 'Token Refreshed!',
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }
    

    public function logout() {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success!',
        ]);
    }
    
}
