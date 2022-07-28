<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $reservation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($r)
    {
        $this->reservation = $r;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        QrCode::format('png')->size(300)->generate(url("/") . '/showQr/' . $this->reservation->id, public_path('/files/qr/' . $this->reservation->id . '.png'));
        $qr = url('/').'/files/qr/' . $this->reservation->id . '.png';
        return $this->view('mails.reservationmail', ['reservation' => $this->reservation, 'qr' => $qr]);
    }
}
