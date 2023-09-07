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
                    <table id="datatablesSimple">
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
                    <button type="button" class="btn btn-sm btn-primary close" onclick="$(function () {
                                               $('#modal_ubah').modal('toggle');
                                            });" aria-label="Close">
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

                                    <input type="text" id="ubah_email" name="ubah_email"
                                        class="form-control phone-number">
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
                                    @foreach ($hakakses as $key => $value)
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
                                                        <div style="margin-top: 7px;" id="CheckPasswordMatch">
                                                       <div class=" custom-control custom-checkbox">
                                                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                                                    id="showuwu" onclick="funct_show_password()">
                                                                <label class="custom-control-label" for="showuwu">Tampilkan Password</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <button type="submit" id="editdata" name="editdata" class="btn btn-primary">Simpan Data</button>

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
                        <button type="button" class="btn btn-sm btn-primary close" onclick="$(function () {
   $('#tambahanggota').modal('toggle');
});" aria-label="Close">
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

                                        <input type="text" id="ubah_email" name="ubah_email"
                                            class="form-control phone-number">
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
                                                        <div style="margin-top: 7px;" id="CheckPasswordMatch">
                                                       <div class=" custom-control custom-checkbox">
                                                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                                                    id="showuwu" onclick="funct_show_password()">
                                                                <label class="custom-control-label" for="showuwu">Tampilkan Password</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <button type="submit" id="editdata" name="editdata" class="btn btn-primary">Simpan Data</button>

                                        </div>
                                    </div>
                                </div>
                                </div>


                <div class="modal fade" id="hapuspermanen">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Perubahan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form autocomplete="off" action="{{ url('') }}/reallydelete" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" id="del_id" name="del_id">
                                    <!--FORM TAMBAH BARANG-->
                                    <b>Apakah anda ingin menghapus user ini ?</b>
                                    <P id="NamaUser"> Null </P>

                                    <button type="submit" class="btn btn-primary">Ya</button>
                                    <button data-dismiss="modal" class="btn btn-Secondary">Tidak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="nonaktifkan">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Perubahan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form autocomplete="off" action="{{ url('') }}/reallydeactivated" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" id="deact_id" name="deact_id">
                                    <!--FORM TAMBAH BARANG-->
                                    <b>Apakah anda ingin menonaktifkan user ini ?</b>
                                    <P id="NamaUserx"> Null </P>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                    <button data-dismiss="modal" class="btn btn-Secondary">Tidak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="aktifkankembali">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Perubahan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form autocomplete="off" action="{{ url('') }}/activatedtheuser" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" id="activated_id" name="activated_id">
                                    <!--FORM TAMBAH BARANG-->
                                    <b>Apakah anda ingin mengaktifkan user ini ?</b>
                                    <P id="NamaUserz"> Null </P>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                    <button data-dismiss="modal" class="btn btn-Secondary">Tidak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
                <script type="text/javascript">
                    $(function() {
                        $("#btn_tambahanggota").click(function() {

                            var nama = $("#input_nama").val();
                            var inisial = $("#input_inisial").val();
                            // var count = $("input_inisial").val().length;
                            var nohp = $("#input_nohp").val();
                            var Email = $("#input_Email").val();
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

                    function ubah(id) {

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

                    function hapus(data) {
                        document.getElementById('NamaUser').innerText = 'Nama Pengguna : ' + data.nama + '.';
                        $("#del_id").val(data.id);
                        $("#hapuspermanen").modal('show');
                    }

                    function nonaktifkanx(data) {
                        document.getElementById('NamaUserx').innerText = 'Nama Pengguna : ' + data.nama + '.';
                        $("#deact_id").val(data.id);
                        $("#nonaktifkan").modal('show');
                    }

                    function aktifkanx(data) {
                        document.getElementById('NamaUserz').innerText = 'Nama Pengguna : ' + data.nama + '.';
                        $("#activated_id").val(data.id);
                        $("#aktifkankembali").modal('show');
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

                    function tmbahshwpsz() {
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
                        processing: true,
                        serverSide: true,

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
