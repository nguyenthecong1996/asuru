<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('xtreme-admin/assets/images/favicon.png') }}">
    <title>Login</title>
    <!-- Custom CSS -->
    <link href="{{ asset('xtreme-admin/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('xtreme-admin/dist/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.css">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
    
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url({{ asset('xtreme-admin/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('xtreme-admin/assets/images/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-medium mb-2 mt-3">ログイン画面</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 base-form" id="frm" method="post" action="{{ route('login') }}" novalidate>
                                @csrf
                                <input type="hidden" name="device_token" id="device_token">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="ti-user"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') custom-is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback ct-error d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="ti-pencil"></i></span>
                                    </div>
                                    <input id="password" type="password" class="pwd form-control form-control-lg @error('password') custom-is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                    <button type="button" class="btn-show-password d-none" style="right:5px;"><i class="fas fa-eye"></i></button>
                                    @error('password')
                                            <span class="invalid-feedback ct-error d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror     
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 ">
                                        <button class="btn btn-block btn-lg btn-info btn-submit" type="submit">ログイン</button>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox d-flex justify-content-center">
                                            <!-- <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Remember</label> -->
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-blue">パスワードを忘れる</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12">
                                        <a href="{{ route('register') }}" class="btn btn-block btn-lg btn-success btn-submit">New Account</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="{{ asset('xtreme-admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('xtreme-admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="{{ asset('js/function.js')}}"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    <script>
        @if (Session::has('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
    
</body>

</html>



