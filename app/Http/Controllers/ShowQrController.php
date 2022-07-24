<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ShowQrController extends Controller
{
    public function show($id)
    {
        $reservastion = Reservation::where('id', $id)->first();
        return  view('show', ['reservastion' => $reservastion]);
    }
}
