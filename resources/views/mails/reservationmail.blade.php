<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Rezervasyon Detayları</h1>
                    </div>
                    <hr>
                    <table>
                        <tr>
                            <td>
                                <strong>Ad</strong>
                            </td>
                            <td>
                                : {{ $reservation->FirstName }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Soyad</strong>
                            </td>
                            <td>
                                : {{ $reservation->LastName }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Masa Numarası</strong>
                            </td>
                            <td>
                                : {{ $reservation->TableNumber }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Tutar</strong>
                            </td>
                            <td>
                                : {{ $reservation->Amount }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Kişi Sayısı</strong>
                            </td>
                            <td>
                                : {{ $reservation->Pax }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Rezervasyon Tarihi</strong>
                            </td>
                            <td>
                                : {{ $reservation->CheckInDate }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Rezervasyon Notu</strong>
                            </td>
                            <td>
                                 : {{ $reservation->ReservationNote }}
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>QR Kodu:</h1>
<img src="{{ $qr }}" alt="">
