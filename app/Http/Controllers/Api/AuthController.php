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
    // public function register(Request $request) {
    //     // $request->validate([
    //     //     'name' => 'required|string',
    //     //     'email' => 'required|email|unique:users,email',
    //     //     'password' => 'required|string|confirmed',
    //     // ]);

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string',
    //         'nip' => 'required|string|unique:users,nip',
    //         'phone_number' => 'required|string',
    //         'role_id' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'nip' => $request->nip,
    //         'phone_number' => $request->phone_number,
    //         'role_id' => $request->role_id,
    //     ]);

    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()->json([
    //         'data' => $user,
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }

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

        return response()->json([
            'message' => 'Login Success!',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout() {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success!',
        ]);
    }
    
}
