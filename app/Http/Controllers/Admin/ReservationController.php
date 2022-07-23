<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function new(Request $request)
    {
        $res = new Reservation();
        $res->FirstName=$request->FirstName;
        $res->LastName=$request->LastName;
        $res->TableNumber=$request->TableNumber;
        $res->ReservationNote=$request->ReservationNote;
        $res->Amount=$request->Amount;
        $res->Pax=$request->Pax;
        $res->CheckInDate=$request->CheckInDate;
        $res->save();

    }
}
