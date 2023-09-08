@extends('layouts.app')
@section('master', 'active')
@section('master-0', 'show')
@section('master-0-karyawan', 'active')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endsection
@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Jabatan
                            </h1>
                            <div class="page-header-subtitle">Kendalikan daftar karyawan Anda. Edit dan kelola informasi
                                karyawan secara efisien</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                {{-- <div class="card-header">Extended DataTables</div> --}}
                <div class="text-right p-4">
                    <a class="btn btn-primary lift lift-sm" onclick="tambahAnggota()">Tambah Baru</a>

                </div>
                <div class="card-body">
                    <table autocomplete="false" id="datatablesSimple" class="table compact table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    {{-- UBAH DATA --}}
    <div class="modal fade" id="modal_ubah" role="dialog">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Pengguna</h5>
                    <button type="button" class="btn btn-sm btn-primary close"
                        onclick="$(function () {
                                               $('#modal_ubah').modal('toggle');
                                            });"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="ubah_id" name="ubah_id">
                    <!--FORM edit anggta-->
                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" id="ubah_nama" name="ubah_nama">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                    </div>

                                    <input type="text" id="ubah_email" name="ubah_email" class="form-control ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Hak Akses</label>
                                <select class=" form-select" id="ubah_hak_akses" required>
                                    <option value="" selected> Pilih Hak Akses</option>
                                    @foreach ($hakakses as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Status Akun</label>
                                <select class=" form-select" id="ubah_status" required>
                                    <option value="" selected>Tetapkan Status</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">NIP</label>
                                <input type="number" class="form-control" name="ubah_nip" id="ubah_nip">

                            </div>
                        </div>
                    </div>


                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control" name="ubah_password" id="ubah_password">
                                <div style="margin-top: 7px;" id="CheckPasswordMatch">
                                    <p>Harap password harus sama dengan konfirmasi password</p>
                                </div>

                            </div>
                        </div>
                        <span id='message'></span>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="ubah_confirm_password"
                                    id="ubah_confirm_password" ">
                                                                                    <div style=" margin-top: 7px;"
                                        id="CheckPasswordMatch">
                                    <div class=" custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                            id="showuwu" onclick="funct_show_password()">
                                        <label class="custom-control-label" for="showuwu">Tampilkan Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col">
                            <button onclick="ubah()" type="submit" id="editdata" name="editdata" class="btn btn-primary">Simpan Data</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- Tambah DATA --}}
        <div class="modal fade" id="tambahanggota" role="dialog">
            <div class="modal-lg modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengguna</h5>
                        <button type="button" class="btn btn-sm btn-primary close"
                            onclick="$(function () { $('#tambahanggota').modal('toggle'); });" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--FORM edit anggta-->
                        <div class="row m-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" id="input_nama" name="input_nama">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                        </div>

                                        <input type="text" id="input_Email" name="input_Email" class="form-control ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row m-3">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Hak Akses</label>
                                    <select class=" form-select" id="input_hak_akses" required>
                                        <option value="" selected> Pilih Hak Akses</option>
                                          @foreach ($hakakses as $key=> $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Status Akun</label>
                                <select class=" form-select" id="input_status" required>
                                    <option value="" selected>Tetapkan Status</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">NIP</label>
                                <input type="number" class="form-control" name="nip" id="nip">

                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control" name="password_input" id="password_input">
                                <div style="margin-top: 7px;" id="CheckPasswordMatch">
                                    <p>Harap password harus sama dengan konfirmasi password</p>
                                </div>

                            </div>
                        </div>
                        <span id='message'></span>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password_input"
                                    id="confirm_password_input" ">
                                                                                    <div style=" margin-top: 7px;"
                                        id="CheckPasswordMatch">
                                    <div class=" custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                            id="showuwu" onclick="funct_show_password_new()">
                                        <label class="custom-control-label" for="showuwu">Tampilkan Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col">

                            <button type="submit" id="btn_tambahanggota" name="btn_tambahanggota" onclick="tambahBaru()"
                                class="btn btn-primary">Simpan Data</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



@endsection
@section('script')
        <script type="text/javascript">
            $(function() {
                $("#btn_tambahanggota").click(function() {
                    $("#confirm_password_input").removeClass("is-invalid")
                    $("#password_input").removeClass("is-invalid")
                    var password_input = $("#password_input").val();
                    var confirm_password_input = $("#confirm_password_input").val();
                    if (password_input != confirm_password_input) {
                        $("#confirm_password_input").addClass("is-invalid")
                        $("#password_input").addClass("is-invalid")
                        return false;
                    }
                    return true;
                });
            });

            function ubah() {

                var ubah_id = $("#ubah_id").val();
                var ubah_email = $("#ubah_email").val();
                var ubah_nip = $("#ubah_nip").val();
                var ubah_nama = $("#ubah_nama").val();
                var ubah_hak_akses = $("#ubah_hak_akses").val();
                var ubah_status = $("#ubah_status").val();
                var ubah_password = $("#ubah_password").val();
                var ubah_confirm_password = $("#ubah_confirm_password").val();

                if (
                    ubah_id === "" ||
                    ubah_email === "" ||
                    ubah_nip === "" ||
                    ubah_nama === "" ||
                    ubah_hak_akses === "" ||
                    ubah_status === "" ||
                    ubah_password === "" ||
                    ubah_confirm_password === ""
                ) {
                    Swal.fire({
                        title: "Ada yang kosong",
                        html: '<b>Periksa kembali isian nya</b>',
                        icon: 'danger',
                        confirmButtonText: 'OK'
                    })
                    return false;
                }

                var dataarray = new FormData();
                var CSRF_TOKEN = "{{ csrf_token() }}";
                dataarray.append('ubah_id', ubah_id);
                dataarray.append('ubah_email', ubah_email);
                dataarray.append('ubah_nip', ubah_nip);
                dataarray.append('ubah_nama', ubah_nama);
                dataarray.append('ubah_hak_akses', ubah_hak_akses);
                dataarray.append('ubah_status', ubah_status);
                dataarray.append('ubah_password', ubah_password);
                dataarray.append('ubah_confirm_password', ubah_confirm_password);
                dataarray.append('_token', CSRF_TOKEN);
                Swal.fire({
                    html: 'Ubah data Karyawan?',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                    customClass: {
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= url('employee/update') ?>",
                            method: "POST",
                            data: dataarray,
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            type: 'post',
                            success: function(data) {

                                if (data.isSuccess == 'yes') {
                                    Swal.fire({
                                        title: "Berhasil",
                                        html: '<b>Halaman akan kembali ke menu utama</b>',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    })

                                    window.location.replace("<?= url('employee') ?>");
                                    console.log('masuk')
                                } else {
                                    Swal.fire({
                                        html: "<h4>Kesalahan</h4>",
                                        icon: 'warning',
                                        showCancelButton: false, // There won't be any cancel button
                                        showConfirmButton: false // There won't be any confirm button
                                    });
                                    // setTimeout(location.reload.bind(location), 1500);
                                }

                            }
                        });
                    } else if (result.isDenied) {
                        return false;
                    }
                });

            }

            function tambahBaru() {

                var input_nama = $("#input_nama").val();
                var input_Email = $("#input_Email").val();
                var input_hak_akses = $("#input_hak_akses").val();
                var nip = $("#nip").val();
                var ubah_status = $("#input_status").val();
                var password_input = $("#password_input").val();
                var confirm_password_input = $("#confirm_password_input").val();

                if (
                    nip === "" ||
                    input_nama === "" ||
                    input_Email === "" ||
                    input_hak_akses === "" ||
                    ubah_status === "" ||
                    password_input === "" ||
                    confirm_password_input === ""
                ) {
                    Swal.fire({
                        title: "Ada yang kosong",
                        html: '<b>Periksa kembali isian nya</b>',
                        icon: 'danger',
                        confirmButtonText: 'OK'
                    })
                    return false;
                }

                var dataarray = new FormData();
                var CSRF_TOKEN = "{{ csrf_token() }}";
                dataarray.append('nip', nip);
                dataarray.append('input_nama', input_nama);
                dataarray.append('input_Email', input_Email);
                dataarray.append('input_hak_akses', input_hak_akses);
                dataarray.append('ubah_status', ubah_status);
                dataarray.append('password_input', password_input);
                dataarray.append('confirm_password_input', confirm_password_input);
                dataarray.append('_token', CSRF_TOKEN);
                Swal.fire({
                    html: 'Tambah Baru Karyawan?',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                    customClass: {
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= url('employee/store') ?>",
                            method: "POST",
                            data: dataarray,
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            type: 'post',
                            success: function(data) {

                                if (data.isSuccess == 'yes') {
                                    Swal.fire({
                                        title: "Berhasil",
                                        html: '<b>Halaman akan kembali ke menu utama</b>',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    })

                                    window.location.replace("<?= url('employee') ?>");
                                    console.log('masuk')
                                } else {
                                    Swal.fire({
                                        html: "<h4>Kesalahan</h4>",
                                        icon: 'warning',
                                        showCancelButton: false, // There won't be any cancel button
                                        showConfirmButton: false // There won't be any confirm button
                                    });
                                    // setTimeout(location.reload.bind(location), 1500);
                                }

                            }
                        });
                    } else if (result.isDenied) {
                        return false;
                    }
                });

            }

            $(function() {
                $("#editdata").click(function() {
                    var nama = $("#ubah_nama").val();
                    var inisial = $("#ubah_inisial").val();
                    var nohp = $("#ubah_email").val();
                    var Email = $("#ubah_Email").val();
                    if (nama == '') {
                        alert("Ada yang kosong, Coba periksa lagi");
                        return false;
                    } else if (inisial == '') {
                        alert("Ada yang kosong, Coba periksa lagi");
                        return false;
                    } else if (nohp == '') {
                        alert("Ada yang kosong, Coba periksa lagi");
                        return false;
                    } else if (Email == '') {
                        alert("Ada yang kosong, Coba periksa lagi");
                        return false;
                    }
                    return true;

                });
            });

            $(function() {
                $("#editdata").click(function() {
                    $("#ubah_password").removeClass("is-invalid");
                    $("#ubah_confirm_password").removeClass("is-invalid");
                    var password = $("#ubah_password").val();
                    var confirmPassword = $("#ubah_confirm_password").val();
                    if (password != confirmPassword) {
                        $("#ubah_password").addClass("is-invalid");
                        $("#ubah_confirm_password").addClass("is-invalid");
                        return false;
                    }
                    return true;
                });
            });

            function tambahAnggota() {
                $('#tambahanggota').modal('show');
            }

            function change(id) {

                var dataarray = new FormData();

                $.ajax({
                    url: "<?php echo url('employee/api'); ?>?id=" + id,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: 'GET',
                    success: function(data) {

                        if (data != null) {
                            console.log(data);
                            $("#ubah_id").val(data.id);
                            $("#ubah_email").val(data.email);
                            $("#ubah_nip").val(data.nip);
                            // $("#ubah_password").val('');
                            $("#ubah_nama").val(data.name);
                            $("#ubah_hak_akses").val(data.role_id).change();
                            $("#ubah_status").val(data.status).change();
                            $("#modal_ubah").modal('show');
                        } else {
                            Swal.fire({
                                html: "<h4>Kesalahan</h4>",
                                icon: 'warning',
                                showCancelButton: false, // There won't be any cancel button
                                showConfirmButton: false // There won't be any confirm button
                            });
                            // setTimeout(location.reload.bind(location), 1500);
                        }

                    }
                });


            }

                  function activate(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'delete');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'Aktifkan akses Karyawan ini ? ',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                customClass: {
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= url('employee/activate') ?>",
                        method: "POST",
                        data: dataarray,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        type: 'post',
                        success: function(data) {

                           if(data.isSuccess == 'yes'){
                        Swal.fire({
                            title: "data terhapus",
                            html: '<b>Halaman akan kembali ke menu utama</b>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            })

                            window.location.replace( "<?= url('employee') ?>");
                    console.log('masuk')
                    }else {
                                Swal.fire({
                                    html: "<h4>Kesalahan</h4>",
                                    icon: 'warning',
                                    showCancelButton: false, // There won't be any cancel button
                                    showConfirmButton: false // There won't be any confirm button
                                });
                                // setTimeout(location.reload.bind(location), 1500);
                            }

                        }
                    });
                } else if (result.isDenied) {
                    return false;
                }
            });
        }

         function deactivate(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'delete');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'matikan akses Karyawan ini ? ',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                customClass: {
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= url('employee/deactivate') ?>",
                        method: "POST",
                        data: dataarray,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        type: 'post',
                        success: function(data) {

                           if(data.isSuccess == 'yes'){
                        Swal.fire({
                            title: "data terhapus",
                            html: '<b>Halaman akan kembali ke menu utama</b>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            })

                            window.location.replace( "<?= url('employee') ?>");
                    console.log('masuk')
                    }else {
                                Swal.fire({
                                    html: "<h4>Kesalahan</h4>",
                                    icon: 'warning',
                                    showCancelButton: false, // There won't be any cancel button
                                    showConfirmButton: false // There won't be any confirm button
                                });
                                // setTimeout(location.reload.bind(location), 1500);
                            }

                        }
                    });
                } else if (result.isDenied) {
                    return false;
                }
            });
        }

      function hapus(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'delete');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'Hapus akses Karyawan ini ? ',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                customClass: {
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= url('employee/delete') ?>",
                        method: "POST",
                        data: dataarray,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        type: 'post',
                        success: function(data) {

                           if(data.isSuccess == 'yes'){
                        Swal.fire({
                            title: "data terhapus",
                            html: '<b>Halaman akan kembali ke menu utama</b>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            })

                            window.location.replace( "<?= url('employee') ?>");
                    console.log('masuk')
                    }else {
                                Swal.fire({
                                    html: "<h4>Kesalahan</h4>",
                                    icon: 'warning',
                                    showCancelButton: false, // There won't be any cancel button
                                    showConfirmButton: false // There won't be any confirm button
                                });
                                // setTimeout(location.reload.bind(location), 1500);
                            }

                        }
                    });
                } else if (result.isDenied) {
                    return false;
                }
            });
        }



            function funct_show_password() {
                var x = document.getElementById("ubah_password");
                var y = document.getElementById("ubah_confirm_password");
                if (x.type === "text" || y.type === "text") {
                    x.type = "password";
                    y.type = "password";
                } else {
                    x.type = "text";
                    y.type = "text";
                }
            }

            function funct_show_password_new() {
                var z = document.getElementById("password_input");
                var a = document.getElementById("confirm_password_input");
                if (z.type === "text" || a.type === "text") {
                    z.type = "password";
                    a.type = "password";
                } else {
                    z.type = "text";
                    a.type = "text";
                }
            }



            $('#datatablesSimple').DataTable({
                lengthMenu: [30, 60, 80, 120],
                fixedHeader: {
                    header: true
                },
                serverSide: true,
                autoFill: false,

                ajax: '<?= url('/employee/api') ?>',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'role_users',
                        name: 'role_users'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        </script>
@endsection
