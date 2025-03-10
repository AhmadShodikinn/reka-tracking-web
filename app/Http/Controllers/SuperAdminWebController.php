<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminWebController extends Controller
{
    //super admin handling management user
    public function index() {
        $users = User::all();

        return view('dashboard', compact('users')); //set view
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'nip' => 'required|string|unique:users,nip',
            'phone_number' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nip' => $request->nip,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('dashboard'); //set view
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'nip' => 'required|string',
            'phone_number' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('dashboard'); //set view
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard'); //set view
    }

    // Admin 
    


}
