<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthWebController extends Controller
{
    public function login(Request $request) {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt((['email' => $request->email, 'password' => $request->password]))) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Email or password is wrong');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
