<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }
    public function get(Request $request)
    {
        $user = User::where("id", $request->id)->first();
        return response()->json([
            'status' => 2,
            'user' => $user,
            'response' => "Kullanıcı Getirildi!"
        ], 200);
    }
    public function delete(Request $request)
    {
        $user = User::where("id", $request->id)->delete();
        return response()->json([
            'status' => 2,
            'user' => $user,
            'response' => "Kullanıcı Silindi!"
        ], 200);
    }
    public function edit(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $editedUser['name'] = $request->name;
        $editedUser['email'] = $request->email;
        if (isset($request->password))
            $editedUser['password'] = Hash::make($request->password);

        User::where("id", $request->id)->update($editedUser);
        return response()->json([
            'status' => 2,
            'response' => "Kullanıcı Güncellendi!"
        ], 200);
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 2,
            'response' => "Kullanıcı Eklendi!"
        ], 200);
    }
}
