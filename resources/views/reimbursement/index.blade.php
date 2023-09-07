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
                        <div class="page-header-subtitle">Kelola pengembalian uang mu disini. pengajuan akan segera ditinjau oleh atasan.</div>
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
                <a class="btn btn-primary lift lift-sm" href="#!">Tambah Baru</a>
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
</main>

@endsection
@section('script')
<script type="text/javascript">

        function hapus(data) {
            document.getElementById('NamaUser').innerText = 'Nama Pengguna : ' + data.nama + '.';
            $("#del_id").val(data.id);
            $("#hapuspermanen").modal('show');
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
