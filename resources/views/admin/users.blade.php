@extends('layouts.admin')
@section('title')
    Kullanıcılar
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('header')
    Kullanıcılar
@endsection
@section('content')
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive p-5">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ad Soyad</th>
                            <th>E-mail</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($users))
                            @foreach ($users as $res)
                                <tr>
                                    <td>{{ $res->name }}</td>
                                    <td>{{ $res->email }}</td>
                                    <td>
                                        <div class="dropdown mb-4">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                İşlemler
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item editUser" href="#"
                                                    data-id="{{ $res->id }}">
                                                    Düzenle </a>
                                                <a class="dropdown-item showqr" href="#"
                                                    data-id="{{ $res->id }}"> Sil </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif

                    </tbody>
                </table>
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
                    <form class="user userEdit">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Ad Soyad" autocomplete="off">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="E-mail" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="Amount" name="password"
                                    placeholder="Şifre" autocomplete="off">
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
<script>

        // Düzenlenecek user ı getirme start
        $('body').on('click', '.editUser', function() {
            var formData = {};
            formData['id'] = $(this).data("id");
            $.ajax({
                url: '/admin/user/get',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        $('#editModal').modal('show');
                        $('#editModal input[name="name"]').val(data.user.name);
                        $('#editModal input[name="email"]').val(data.reservation.email);
                    } else {
                        console.log(data);
                    }
                }
            });

        });
        // Düzenlenecek user ı getirme end

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
