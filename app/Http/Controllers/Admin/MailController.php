<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $reservation = Reservation::find($request->id);
        Mail::to($reservation->email)->send(new ReservationMail($reservation));
        return response()->json([
            'status' => 2,
            'response' => "Mail Başarı ile gönderildi!"
        ], 200);
    }
}
