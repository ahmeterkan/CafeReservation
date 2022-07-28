<?php

namespace App\Repository;

use App\Models\Reservation;
use Carbon\Carbon;

class Functions
{
    public static function countReservationDay()
    {
        return Reservation::where("CheckInDate", Carbon::now()->isoFormat('YYYY-MM-DD'))->count();
    }
    public static function countPaxDay()
    {
        return Reservation::where("CheckInDate", Carbon::now()->isoFormat('YYYY-MM-DD'))->sum('Pax');
    }
    public static function countAmountDay()
    {
        return Reservation::where("CheckInDate", Carbon::now()->isoFormat('YYYY-MM-DD'))->sum('Amount');
    }
}
