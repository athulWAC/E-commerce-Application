<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css ') }}">
    <link rel="stylesheet" href=" {{ asset('public/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.css ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/pages/auth.css ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.css ') }}">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.svg') }}" type="image/x-icon">


</head>



<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-6 col-12 ">
                <div id="auth-left" class="card-body">

                    <h1 class="auth-title">Login.</h1>
                    <p class="auth-subtitle mb-5">Login to start your work</p>

                    <form action="{{ route('loginVal') }}" method="post" id="loginForm">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email" name="email"
                                id="email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password" id="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        {{-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> --}}

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>


                        <div class="text-center mt-5 text-lg fs-4">
                            {{-- <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                        up</a>.</p> --}}
                            <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                        </div>
                        {{-- <div class="alert alert-danger alert-dismissible show fade">
                                This is a danger alert.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> --}}

                        @if (Session::has('error'))
                            <div
                                class="alert alert-danger alert-dismissible show fade {{ Session::has('error') ? 'alert-important' : '' }}">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                {{ Session::get('error') }}
                            </div>
                        @endif

                    </form>



                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);

    </script>
    <script src="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js ') }}">
    </script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js ') }}">
    </script>
    <script src="{{ asset('public/assets/js/mazer.js  ') }}"></script>
</body>

</html>
