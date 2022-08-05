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
                <div class="p-1" style="float: right;">
                    <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Kullanıcı Ekle</span>
                    </a>
                </div>
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
                                                <a class="dropdown-item deleteUser" href="#"
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

    {{-- kullanıcı ekleme modal --}}
    <div class="modal" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Kullanıcı Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body qr" style="text-align: center">
                    <form class="user userAdd">
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
                                <input type="password" class="form-control form-control-user" id="password" name="password"
                                    placeholder="Şifre" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary saveAdded">Kaydet</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    {{-- kullanıcı ekleme modal --}}

    {{-- kullanıcı düzenleme modal --}}
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kullanıcı Bilgilerini Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body qr" style="text-align: center">
                    <form class="user userEdit">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="name"
                                    name="name" placeholder="Ad Soyad" autocomplete="off">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="email"
                                    name="email" placeholder="E-mail" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password"
                                    name="password" placeholder="Şifre" autocomplete="off">
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
    {{-- kullanıcı düzenleme modal --}}

@endsection

@section('script')
    <script>
        // Düzenlenecek user ı getirme start
        $('body').on('click', '.editUser', function() {
            var formData = {};
            formData['id'] = $(this).data("id");
            LoadingScreen(1);
            $.ajax({
                url: '/admin/user/get',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        $('#editModal').modal('show');
                        $('#editModal input[name="id"]').val(data.user.id);
                        $('#editModal input[name="name"]').val(data.user.name);
                        $('#editModal input[name="email"]').val(data.user.email);
                        toastr.success(data.response);
                        LoadingScreen(0);
                    } else {
                        toastr.warning(data.response);
                        LoadingScreen(0);
                    }
                }
            });

        });
        // Düzenlenecek user ı getirme end

        // düzenlemleri kaydet start
        $('body').on('click', '.saveEdited', function() {
            event.preventDefault();

            var formData = $('.userEdit').find('input, textarea, select').serialize();
            LoadingScreen(1);
            $.ajax({
                url: '/admin/user/edit',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        toastr.success(data.response);
                        window.location.reload();
                        LoadingScreen(0);
                    } else {
                        toastr.warning(data.response);
                        LoadingScreen(0);
                    }
                },
                error: function(data) {
                    switch (data.status) {
                        case 422:
                            for (const key in data.responseJSON.errors) {
                                toastr.warning("Girdi alanlarını eksiksiz ve doğru doldurduğunuzdan emin olun!");
                            }
                    }
                    LoadingScreen(0);
                }
            });

        });
        // düzenlemleri kaydet işlemi end

        // Yeni Kullanıcı kaydet start
        $('body').on('click', '.saveAdded', function() {
            event.preventDefault();

            var formData = $('.userAdd').find('input, textarea, select').serialize();
            LoadingScreen(1);
            $.ajax({
                url: '/admin/user/add',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        toastr.success(data.response);
                        window.location.reload();
                        LoadingScreen(0);
                    } else {
                        toastr.warning(data.response);
                        LoadingScreen(0);
                    }
                },
                error: function(data) {
                    switch (data.status) {
                        case 422:
                            for (const key in data.responseJSON.errors) {
                                toastr.warning("Girdi alanlarını eksiksiz ve doğru doldurduğunuzdan emin olun!");
                            }
                    }
                    LoadingScreen(0);
                }
            });

        });
        // Yeni Kullanıcı kaydet end

        // Düzenlenecek user ı getirme start
        $('body').on('click', '.deleteUser', function() {
            var formData = {};
            formData['id'] = $(this).data("id");
            LoadingScreen(1);
            $.ajax({
                url: '/admin/user/delete',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        toastr.success(data.response);
                        window.location.reload();
                        LoadingScreen(0);
                    } else {
                        toastr.warning(data.response);
                        LoadingScreen(0);
                    }
                }
            });

        });
        // Düzenlenecek user ı getirme end
    </script>
@endsection
