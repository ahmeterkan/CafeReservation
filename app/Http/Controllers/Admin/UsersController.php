<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users= User::all();
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
}
