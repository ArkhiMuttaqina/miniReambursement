@extends('layouts.app')

@if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)

@endif
@section('reimbursement', 'active')
@section('reimbursement-0', 'show')
@section('reimbursement-0-semualist', 'active')
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
                            Daftar Pengajuan Pengembalian Uang
                        </h1>
                        <div class="page-header-subtitle">Kelola pengembalian uang staf Anda. Edit reimbursements dengan praktis dan akurat.</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills" id="cardPill" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="semua-pill" href="#semuaPill" data-bs-toggle="tab"
                                        role="tab" aria-controls="semua" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="needAction-pill" href="#needActionPill" data-bs-toggle="tab"
                                        role="tab" aria-controls="needAction" aria-selected="false">Need Action</a></li>

                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="cardPillContent">
                                <div class="tab-pane fade show active" id="semuaPill" role="tabpanel" aria-labelledby="semua-pill">
                                    <div class="text-right p-4">
                                        <a class="btn btn-primary lift lift-sm" href="#!">Tambah Baru</a>
                                    </div>
                                   <table id="datatablesSimpleALL" class="table compact table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>Deskripsi</th>
                                                            <th>Nominal</th>
                                                            <th>Pembuat</th>
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
                                <div class="tab-pane fade" id="needActionPill" role="tabpanel" aria-labelledby="needAction-pill">
                                   <table id="datatablesSimpleUpdate" class="table compact table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>Deskripsi</th>
                                                            <th>Nominal</th>
                                                            <th>Pembuat</th>
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
                        </div>
                    </div>
    </div>
</main>

@endsection
@section('script')
<script type="text/javascript">
    function hapus(data) {
            document.getElementById('NamaUser').innerText = 'Nama Pengguna : ' + data.nama + '.';
            $("#del_id").val(data.id);
            $("#hapuspermanen").modal('show');
        }


        $('#datatablesSimpleALL').DataTable({
            lengthMenu: [30, 60, 80, 120],
            fixedHeader: {
                header: true
            },
            processing: true,
            serverSide: true,

            ajax: '<?= url('/reimbursement/api/all?state=all') ?>',
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
                    data: 'creator',
                    name: 'creator'
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

        $('#datatablesSimpleUpdate').DataTable({
            lengthMenu: [30, 60, 80, 120],
            fixedHeader: {
                header: true
            },
            processing: true,
            serverSide: true,

            ajax: '<?= url('/reimbursement/api/all?state=update') ?>',
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
                    data: 'creator',
                    name: 'creator'
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
