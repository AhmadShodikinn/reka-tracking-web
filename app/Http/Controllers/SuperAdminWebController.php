<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminWebController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('General.users', compact('users')); 
    }

    public function searchUser(Request $request){
        $query = $request->input('search');

        $results = User::with('role')
            ->where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('nip', 'like', "%$query%")
            ->get();

        return response()->json(['results' => $results]);
    }

    public function add() {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('General.users-add', compact('roles')); 
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('General.users-edit', compact('user', 'roles'));
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'nip' => 'required|string|unique:users,nip',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string',
            'role' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make("password"),
            'nip' => $request->nip,
            'phone_number' => $request->telephone,
            'role_id' => $request->role,
        ]);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'nip' => 'required|string|unique:users,nip,' . $id, 
            'email' => 'required|email|unique:users,email,' . $id, 
            'telephone' => 'required|string',
            'role' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::findOrFail($id);
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->phone_number = $request->telephone;
        $user->role_id = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->role->name == 'Super Admin') {
            return redirect()->route('users.index')->with('error', 'Super Admin tidak dapat dihapus.');
        }

        if ($user->hasAnyRelationship()) {
            return redirect()->route('users.index')->with('error', 'Pengguna ini tidak bisa dihapus karena masih terikat dengan data lain.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }


}
