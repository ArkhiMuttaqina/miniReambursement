<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">

            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            @if (auth()->user()->role_id == 3)
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link collapsed @yield('master')" href="javascript:void(0);" data-bs-toggle="collapse"
                data-bs-target="#Core" aria-expanded="false" aria-controls="Core">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Master
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse @yield('master-0')" id="Core" data-bs-parent="#Core">
                <nav class="sidenav-menu-nested nav accordion " id="accordionSidenavPages">
                    <a class="nav-link @yield('master-0-karyawan')" href="{{ route('employee') }}">
                        Karyawan
                        {{-- <span class="badge bg-primary-soft text-primary ms-auto">Updated</span> --}}
                    </a>
                    {{-- <a class="nav-link @yield('master-0-jabatan')" href="{{ route('role') }}">Jabatan</a> --}}
                </nav>
            </div>
            @endif
            <!-- Sidenav Heading (Custom)-->
            <div class="sidenav-menu-heading">Apps</div>
            <!-- Sidenav Accordion (Pages)-->
            <a class="nav-link collapsed @yield('reimbursement')" href="javascript:void(0);" data-bs-toggle="collapse"
                data-bs-target="#Apps" aria-expanded="false" aria-controls="Apps">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Reimbursement
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse @yield('reimbursement-0')" id="Apps" data-bs-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link @yield('reimbursement-0-pengajuansaya')" href="{{ url('/reimbursement?me='.auth()->user()->id) }}">
                        Pengajuan Saya
                        {{-- <span class="badge bg-primary-soft text-primary ms-auto">Updated</span> --}}
                    </a>
                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                    <a class="nav-link @yield('reimbursement-0-semualist')" href="{{ url('/reimbursement/all?role='.auth()->user()->role_id) }}">Semua List</a>
                    @endif

                </nav>
            </div>

            {{-- <!-- Sidenav Heading (UI Toolkit)-->
            <div class="sidenav-menu-heading">Finance</div>
            <a class="nav-link collapsed @yield('finance')" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#Finance"
                    aria-expanded="false" aria-controls="Finance">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    List pengembalian
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @yield('finance-0')" id="Finance" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link @yield('finance-0-semualist ')" href="href="{{ url('/finance?role='.auth()->user()->role_id) }}">Semua List</a>
                    </nav>
                </div> --}}

    </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{auth()->user()->name}}</div>
        </div>
    </div>
</nav>
