<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Repository\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function new(Request $request)
    {
        $res = new Reservation();
        $res->FirstName = $request->FirstName;
        $res->LastName = $request->LastName;
        $res->TableNumber = $request->TableNumber;
        $res->ReservationNote = $request->ReservationNote;
        $res->Amount = $request->Amount;
        $res->Pax = $request->Pax;
        $res->CheckInDate = Carbon::createFromFormat("d/m/Y", $request->CheckInDate)->format("Y-m-d");
        $res->save();
        $html =  view('admin.modals.qrmodal', ['url' => url("/").'/showQr/'.$res->id])->render();
        return response()->json([
            'status' => 2,
            'html' => $html,
            'response' => "Rezervasyon Oluşturuldu!"
        ], 200);
    }
}
