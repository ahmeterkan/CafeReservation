<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $mail =  Mails::first();

        return view('admin.settings', ['mail' => $mail]);
    }

    public function save(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'host' => 'required',
            'port' => 'required',
            'from_address' => 'required',
            'from_name' => 'required',
            'encryption' => 'required',
            'username' => 'required',
            'password' => 'required',
        ], [], [
            'host' => 'FirstName',
            'port' => 'LastName',
            'from_address' => 'TableNumber',
            'from_name' => 'Amount',
            'encryption' => 'Pax',
            'username' => 'Pax',
            'password' => 'Pax',
        ]);
        Mails::where("id", $request->id)->update($request->all());

        return response()->json([
            'status' => 2,
            'response' => "Mail Ayarları Başarıyla Güncellendi!"
        ], 200);
    }
}
