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
                                    <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName"
                                        placeholder="Ad">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="LastName" name="LastName"
                                        placeholder="Soyad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="Amount" name="Amount"
                                        placeholder="Tutar">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="Pax" name="Pax"
                                        placeholder="Kişi Sayısı">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="TableNumber" name="TableNumber"
                                        placeholder="Masa Numarası">
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

                            <a href="#" class="btn btn-primary btn-user btn-block makeReservation">
                                Rezervasyonu Oluştur
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- // daterangepicker start --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    {{-- // daterangepicker end --}}

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
                    //console.log(data);
                    if (data.replace(/\s+/g, "") == 'edited') {
                        $('#editLinkModal').modal('hide');
                        $('.searchLinks').trigger("click");
                    }
                    if (data.replace(/\s+/g, "") == 'nosales') {
                        //console.log(data);
                        toastr.warning(lang['voucher_not_found']);
                    }
                }
            });

        });
        // rezervasyon post işlemi end
    </script>
@endsection
