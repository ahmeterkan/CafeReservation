@extends('layouts.admin')
@section('title')
    Rezervasyon Oluşturma
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('header')
    Rezervasyon Oluşturma
@endsection
@section('content')
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="p-5">
                        <form class="user reservation">
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
                                    {{-- <input type="text" class="form-control form-control-user" id="CheckInDate" placeholder="Tarih"> --}}

                                    <input class="form-control form-control-user" id="CheckInDate" type="text"
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
                            {{-- {!! QrCode::generate('Make me into a QrCode!'); !!} --}}
                            <a href="#" class="btn btn-primary btn-user btn-block makeReservation">
                                Rezervasyonu Oluştur
                            </a>
                        </form>
                    </div>
                </div>
            </div>
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
        $('input[name="CheckInDate"]').daterangepicker({
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

        // rezervasyon post işlemi start
        $('body').on('click', '.makeReservation', function() {
            event.preventDefault();

            var formData = $('.reservation').find('input, textarea, select').serialize();

            $.ajax({
                url: '/admin/reservation/new',
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
        // rezervasyon post işlemi end

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
