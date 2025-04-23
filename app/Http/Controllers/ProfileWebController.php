<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProfileWebController extends Controller
{
    public function update(Request $request) {
        $user = Auth::user();
        $id = $user->id;

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'fullname'  => 'required|string',
            'nip'       => 'required|string|unique:users,nip,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name         = $request->fullname;
        $user->email        = $request->email;
        $user->nip          = $request->nip;
        $user->phone_number = $request->telephone;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
