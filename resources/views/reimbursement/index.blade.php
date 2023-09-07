@extends('layouts.app')

@if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
@endif
@section('reimbursement', 'active')
@section('reimbursement-0', 'show')
@section('reimbursement-0-pengajuansaya', 'active')
@section('head')
    <title>Reimbursement - List</title>
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
                                <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                                Pengajuan Pengembalian Uang
                            </h1>
                            <div class="page-header-subtitle">Kelola pengembalian uang mu disini. pengajuan akan segera
                                ditinjau oleh atasan.</div>
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
                    <a class="btn btn-primary lift lift-sm" href="{{ route('reimbursement_create') }}">Tambah Baru</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table compact table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>Disetujui</th>
                                <th>status</th>
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

    <div class="modal fade" id="lihatPengajuan" role="dialog">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Singkat Pengajuan</h5>
                    <button type="button" class="btn btn-sm btn-primary close"
                        onclick="$(function () { $('#lihatPengajuan').modal('toggle'); });" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM edit anggta-->
                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input disabled type="text" class="form-control" id="nama_reimbursement"
                                    name="nama_reimbursement">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-bill-1-wave"></i>
                                        </div>
                                    </div>

                                    <input  disabled type="text" id="nominal_reimbursement" name="nominal_reimbursement"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Deskripsi Pengajuan</label>
                                <input disabled type="text" class="form-control" name="desc" id="desc">
                                <div style="margin-top: 7px;" id="CheckPasswordMatch">
                                    <p>Harap password harus sama dengan konfirmasi password</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <button type="submit" id="btn_tambahanggota" name="btn_tambahanggota" onclick="tambahBaru()"
                        class="btn btn-primary">Simpan Data</button>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        function showDetail(id) {
            var dataarray = new FormData();
            $.ajax({
                url: "<?php echo url('reimbursement/api'); ?>?id=" + id,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                type: 'GET',
                success: function(data) {

                    if (data != null) {
                        console.log(data);
                        $("#ubah_id").val(data.id);
                        $("#nama_reimbursement").val(data.name);
                        $("#nominal_reimbursement").val(data.mominal).change();
                        $("#desc").val(data.desc).change();
                        $("#lihatPengajuan").modal('show');
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

        function hapus(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'delete');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'Hapus Pengajuan ini ? ',
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
                        url: "<?= url('reimbursement/delete') ?>",
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

                            window.location.replace( "<?= url('reimbursement') ?>");
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
         function rejected(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'approval');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'Batalkan pengajuan ' + name + ' ini ? ',
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
                        url: "<?= url('reimbursement/rejected') ?>",
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
                            title: "Data berhasil diajukan",
                            html: '<b>Halaman akan kembali ke menu utama</b>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            })

                            window.location.replace( "<?= url('reimbursement') ?>");
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


        function approval(id, name) {
            var dataarray = new FormData();
            var CSRF_TOKEN = "{{ csrf_token() }}";
            dataarray.append('id', id);
            dataarray.append('name', name);
            dataarray.append('state', 'approval');
            dataarray.append('_token', CSRF_TOKEN);
            Swal.fire({
                html: 'Ajukan pengajuan ' + name + ' ini ? ',
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
                        url: "<?= url('reimbursement/approval') ?>",
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
                            title: "Data berhasil diajukan",
                            html: '<b>Halaman akan kembali ke menu utama</b>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            })

                            window.location.replace( "<?= url('reimbursement') ?>");
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

        $('#datatablesSimple').DataTable({
            lengthMenu: [30, 60, 80, 120],
            fixedHeader: {
                header: true
            },
            processing: true,
            serverSide: true,

            ajax: '<?= url('/reimbursement/api') ?>',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'desc',
                    name: 'desc'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'approver',
                    name: 'approver'
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
