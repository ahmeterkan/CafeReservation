@extends('layouts.admin')
@section('title')
    Ayarlar
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('header')
    Ayarlar
@endsection
@section('content')
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="p-5">
                <form class="user reservation" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName"
                                placeholder="Ad">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-user" id="LastName" name="LastName"
                                placeholder="Soyad">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <input class="form-control form-control-user" id="CheckInDate" type="text" name="CheckInDate"
                                placeholder="Tarih" />
                        </div>
                        <div class="col-sm-2 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="TableNumber" name="TableNumber"
                                placeholder="Masa Numarası">
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-primary btn-user btn-block " type="submit">
                                Ara
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if (isset($reservastion))
                <div class="table-responsive p-5">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Masa Numarası</th>
                                <th>Tutar</th>
                                <th>Kişi Sayısı</th>
                                <th>Rezervasyon Tarihi</th>
                                <th>Rezervasyon Notu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservastion as $res)
                                <tr>
                                    <td>{{ $res->FirstName }}</td>
                                    <td>{{ $res->LastName }}</td>
                                    <td>{{ $res->TableNumber }}</td>
                                    <td>{{ $res->Amount }}</td>
                                    <td>{{ $res->Pax }}</td>
                                    <td>{{ $res->CheckInDate }}</td>
                                    <td>{{ $res->ReservationNote }}</td>
                                    <td>
                                        <div class="dropdown mb-4">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Dropdown
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item editReservation" href="#"
                                                    data-id="{{ $res->id }}">
                                                    Düzenle </a>
                                                <a class="dropdown-item showqr" href="#"
                                                    data-id="{{ $res->id }}"> Qr
                                                    Kod
                                                    Göster </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="qrModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rezervasyon QR Kodu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body qr" style="text-align: center">
                    <div class=""></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary printQr">Yazdır</button>
                    <button type="button" class="btn btn-info sendMail">E-mail Gönder</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rezervasyon Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body qr" style="text-align: center">
                    <form class="user reservationEdit">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="FirstName"
                                    name="FirstName" placeholder="Ad">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="LastName"
                                    name="LastName" placeholder="Soyad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="Amount"
                                    name="Amount" placeholder="Tutar">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="Pax"
                                    name="Pax" placeholder="Kişi Sayısı">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="TableNumber"
                                    name="TableNumber" placeholder="Masa Numarası">
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control form-control-user" id="CheckInDateModal" type="text"
                                    name="CheckInDate" placeholder="Tarih" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="ReservationNote">Rezervasyon Notu:</label>
                                <textarea type="textarea" class="form-control " id="ReservationNote" name="ReservationNote" rows="5">
                                </textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary saveEdited">Kaydet</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- // daterangepicker start --}}
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    {{-- // daterangepicker end --}}
    <script src="{{ url('js/printThis.js') }}"></script>

    <script>
        // daterangepicker start
        $('input[id="CheckInDate"]').daterangepicker({
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Uygula",
                "cancelLabel": "İptal",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "weekLabel": "H",
                "daysOfWeek": [
                    "Pa",
                    "Pt",
                    "Sa",
                    "Ça",
                    "Pe",
                    "Cu",
                    "Ct"
                ],
                "monthNames": [
                    "Ocak",
                    "Şubat",
                    "Mart",
                    "Nisan",
                    "Mayıs",
                    "Haziran",
                    "Temmuz",
                    "Ağustos",
                    "Eylül",
                    "Ekim",
                    "Kasım",
                    "Aralık"
                ],
                "firstDay": 1
            },
            ranges: {
                'Bugün': [moment(), moment()],
                'Dün': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
                'Son 30 Gün': [moment().subtract(29, 'days'), moment()],
                'Bu Ay': [moment().startOf('month'), moment().endOf('month')],
                'Geçen Ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                'YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });

        $('input[id="CheckInDateModal"]').daterangepicker({
            "singleDatePicker": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Uygula",
                "cancelLabel": "İptal",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "weekLabel": "H",
                "daysOfWeek": [
                    "Pa",
                    "Pt",
                    "Sa",
                    "Ça",
                    "Pe",
                    "Cu",
                    "Ct"
                ],
                "monthNames": [
                    "Ocak",
                    "Şubat",
                    "Mart",
                    "Nisan",
                    "Mayıs",
                    "Haziran",
                    "Temmuz",
                    "Ağustos",
                    "Eylül",
                    "Ekim",
                    "Kasım",
                    "Aralık"
                ],
                "firstDay": 1
            },
            "autoApply": true,
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                'YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
        // daterangepicker end

        // Qr Kod Göster start
        $('body').on('click', '.showqr', function() {
            var formData = {};
            formData['id'] = $(this).data("id");
            $.ajax({
                url: '/admin/reservation/showQr',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        $('#qrModal').modal('show');
                        $('.qr').html(data.html);
                        console.log(data.html);
                    } else {
                        console.log(data);
                        // toastr.warning(lang['voucher_not_found']);
                    }
                }
            });

        });
        // Qr Kod Göster end


        // Düzenlenecek rezervasyonu getirme start
        $('body').on('click', '.editReservation', function() {
            var formData = {};
            formData['id'] = $(this).data("id");
            $.ajax({
                url: '/admin/reservation/get',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        $('#editModal').modal('show');
                        $('#editModal input[name="Amount"]').val(data.reservation.Amount);
                        $('#editModal input[name="FirstName"]').val(data.reservation.FirstName);
                        $('#editModal input[name="LastName"]').val(data.reservation.LastName);
                        $('#editModal input[name="Pax"]').val(data.reservation.Pax);
                        $('#editModal textarea[name="ReservationNote"]').val(data.reservation
                            .ReservationNote);
                        $('#editModal input[name="TableNumber"]').val(data.reservation.TableNumber);
                        $('#editModal input[name="CheckInDate"]').val(data.reservation.CheckInDate);
                        $('#editModal input[name="id"]').val(data.reservation.id);
                    } else {
                        console.log(data);
                        // toastr.warning(lang['voucher_not_found']);
                    }
                }
            });

        });
        // Düzenlenecek rezervasyonu getirme end

        // düzenlemleri kaydet start
        $('body').on('click', '.saveEdited', function() {
            event.preventDefault();

            var formData = $('.reservationEdit').find('input, textarea, select').serialize();

            $.ajax({
                url: '/admin/reservation/edit',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        // $('#qrModal').modal('show');
                        // $('.qr').html(data.html);
                        // console.log(data.html);
                        window.location.reload();
                    } else {
                        console.log(data);
                        // toastr.warning(lang['voucher_not_found']);
                    }
                }
            });

        });
        // düzenlemleri kaydet işlemi end

        //qr kod yazdırma start
        $('body').on('click', '.printQr', function() {
            $('.qr').printThis({
                debug: false,
                importCSS: true,
                importStyle: true,
                printContainer: true,
                printDelay: 333,
                header: null,
                formValues: true
            });
        });
        //qr kod yazdırma start

        //modal kapatıldığında sayfayı yenileme start
        $('#qrModal').on('hidden.bs.modal', function() {
            window.location.reload();
        });
        //modal kapatıldığında sayfayı yenileme start
    </script>
@endsection
