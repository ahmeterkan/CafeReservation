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
        <div class="card-body p-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="mail-tab" data-bs-toggle="tab" data-bs-target="#mail"
                        type="button" role="tab" aria-controls="mail" aria-selected="true">Mail</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                    <div class="p-5">
                        <form class="user mailSettings" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$mail->id}}">
                            <div class="form-group row">
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="host"> <strong>Host</strong></label>
                                    <input type="text" class="form-control form-control-user" id="host"
                                        name="host" placeholder="host" value="{{$mail->host}}">
                                </div>
                                <div class="col-sm-1">
                                    <label for="port"> <strong>Port</strong></label>
                                    <input type="text" class="form-control form-control-user" id="port"
                                        name="port" placeholder="port" value="{{$mail->port}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="from_address"><strong>Gönderim Yapılacak Adres</strong></label>
                                    <input type="text" class="form-control form-control-user" id="from_address"
                                        name="from_address" placeholder="from_address" value="{{$mail->from_address}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="from_name"><strong>Gönderim Yapılacak İsim</strong></label>
                                    <input type="text" class="form-control form-control-user" id="from_name"
                                        name="from_name" placeholder="from_name" value="{{$mail->from_name}}">
                                </div>
                                <div class="col-sm-1">
                                    <label for="encryption"><strong>SSL/TLS</strong></label>
                                    <input type="text" class="form-control form-control-user" id="encryption"
                                        name="encryption" placeholder="encryption" value="{{$mail->encryption}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="username"><strong>Kullancı Adı</strong></label>
                                    <input type="text" class="form-control form-control-user" id="username"
                                        name="username" placeholder="username" value="{{$mail->username}}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="password"><strong>Şifre</strong></label>
                                    <input type="text" class="form-control form-control-user" id="password"
                                        name="password" placeholder="password" value="{{$mail->password}}">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-user btn-block saveMailSettings">
                                        Kaydet
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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


        // düzenlemleri kaydet start
        $('body').on('click', '.saveMailSettings', function() {
            event.preventDefault();

            var formData = $('.mailSettings').find('input, textarea, select').serialize();

            $.ajax({
                url: '/admin/settings/save',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        toastr.success(data.response);
                    } else {
                        toastr.warning(data.response);
                    }
                }
            });

        });
        // düzenlemleri kaydet işlemi end
    </script>
@endsection
