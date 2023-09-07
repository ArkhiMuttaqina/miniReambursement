<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="AppReimburs" />
    <meta name="author" content="ArkhiMS" />
    
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
{{-- <link rel="stylesheet" href="{{asset('css/select2.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/select2-laxxy-v1-theme.css')}}"> --}}
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon.png') }}">
    @yield('head')

</head>

<body class="nav-fixed">
    @include('layouts.topbar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('layouts.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
    </script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29/moment.min.js" crossorigin="anonymous"></script>
{{-- <script src="{{ URL::asset('js/select2.full.js')}}"></script> --}}
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/litepicker.js') }}"></script>
    @yield('script')
</body>

</html>
