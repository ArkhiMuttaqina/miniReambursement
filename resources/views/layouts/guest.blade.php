<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
<link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div style="margin-bottom:-80px; margin-top:-80px;">
                <a href="/">

                    <lottie-player src="https://lottie.host/061d72d4-f3cb-4e93-a06c-6a8524ddaa47/9Gnwe5Bwjy.json" background="#f2f6fc"
                        speed="1" style="width: 400px; height: 400px" loop autoplay direction="1" mode="normal"></lottie-player>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
<link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon.png') }}">
<script src="{{ URL::asset('js/scripts.js') }}"></script>
    </body>
</html>
