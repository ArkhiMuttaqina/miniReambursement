<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="AppReimburs" />
    <meta name="author" content="ArkhiMS" />
    <title>Login AppReimbursement</title>
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon.png') }}">
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-background-softblue">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="row justify-content-center" style="margin-bottom:-80px; ">
                                <lottie-player
                                    src="https://lottie.host/061d72d4-f3cb-4e93-a06c-6a8524ddaa47/9Gnwe5Bwjy.json"
                                    background="#f2f6fc" speed="1" style="width: 400px; height: 400px" loop
                                    autoplay direction="1" mode="normal"></lottie-player>
                            </div>

                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-body">
                                    <div class="row justify-content-left" style="margin-bottom: 10px; ">
                                        <h2><b> Halo, Selamat datang kembali.</b></h2>
                                    </div>
                                    <!-- Login form-->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">

                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" type="email" placeholder="Enter email address"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">

                                            <label class="small mb-1" for="inputPassword">Password</label>

                                            <input class="form-control @error('password') is-invalid @enderror"
                                                id="password" type="password"
                                                placeholder="Enter password"name="password" required
                                                autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- Form Group (remember password checkbox)-->
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Remember password</label>
                                            </div>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="{{ route('password.request') }}">Forgot
                                                Password?</a>
                                            <button type="submit" class="btn btn-primary"> {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="card-footer text-center">
                                    <div class="small"><a href="X">Need an account? Sign up!</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
      @include('layouts.footer')
    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>
