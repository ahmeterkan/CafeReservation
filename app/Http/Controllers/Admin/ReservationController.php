<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Repository\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function new(Request $request)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'TableNumber' => 'required',
            'Amount' => 'required',
            'Pax' => 'required',
        ], [], [
            'FirstName' => 'FirstName',
            'LastName' => 'LastName',
            'TableNumber' => 'TableNumber',
            'Amount' => 'Amount',
            'Pax' => 'Pax',
        ]);
        $res = new Reservation();
        $res->FirstName = $request->FirstName;
        $res->LastName = $request->LastName;
        $res->TableNumber = $request->TableNumber;
        $res->ReservationNote = $request->ReservationNote;
        $res->email = $request->email;
        $res->Amount = $request->Amount;
        $res->Pax = $request->Pax;
        $res->CheckInDate = Carbon::createFromFormat("d/m/Y", $request->CheckInDate)->format("Y-m-d");
        $res->save();
        $html =  view('admin.modals.qrmodal', ['url' => url("/") . '/showQr/' . $res->id])->render();
        return response()->json([
            'status' => 2,
            'html' => $html,
            'id' => $res->id,
            'response' => "Rezervasyon Oluşturuldu!"
        ], 200);
    }
    public function list(Request $request)
    {
        $tarihArray = explode('-', $request->CheckInDate);
        $satis_basla = Carbon::createFromFormat("d/m/Y", trim($tarihArray[0]))->format("Y-m-d");
        $satis_bitis = Carbon::createFromFormat("d/m/Y", trim($tarihArray[1]))->format("Y-m-d");
        $filter = " CheckInDate between '{$satis_basla}' and '{$satis_bitis}' and ";
        if ($request->FirstName != "") {
            $filter .= "FirstName ='{$request->FirstName}' and";
        }
        if ($request->LastName != "") {
            $filter .= "LastName ='{$request->LastName}' and";
        }
        if ($request->TableNumber != "") {
            $filter .= "TableNumber ='{$request->TableNumber}'";
        }
        $filter = rtrim($filter, " and ");
        $reservation = DB::select('select * from reservations where' . $filter);
        return view('admin.reservation.list', ['reservastion' => $reservation]);
    }
    public function showQr(Request $request)
    {
        $html =  view('admin.modals.qrmodal', ['url' => url("/") . '/showQr/' . $request->id])->render();
        return response()->json([
            'status' => 2,
            'html' => $html,
            'id' => $request->id,
            'response' => "Qr Oluşturuldu!"
        ], 200);
    }
    public function get(Request $request)
    {
        $reservation = Reservation::where("id", $request->id)->first();
        $reservation->CheckInDate = Carbon::createFromFormat("Y-m-d", $reservation->CheckInDate)->format("d/m/Y");
        return response()->json([
            'status' => 2,
            'reservation' => $reservation,
            'response' => "Rezervasyon Getirildi!"
        ], 200);
    }
    public function edit(Request $request)
    {
        unset($request['_token']);
        $request['CheckInDate'] = Carbon::createFromFormat("d/m/Y", $request['CheckInDate'])->format("Y-m-d");
        Reservation::where("id", $request->id)->update($request->all());
        return response()->json([
            'status' => 2,
            'response' => "Rezervasyon Güncellendi!"
        ], 200);
    }
}
