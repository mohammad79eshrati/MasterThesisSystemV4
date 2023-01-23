<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <title>ورود</title>
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset("assets/vendor/bootstrap/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}">
    <style>
        @import url("{{asset("assets/css/farsi-fonts-styles/primary-iran-yekan.css")}}");
        @import url("{{asset("assets/css/farsi-fonts-styles/secondary-pinar.css")}}");
    </style>
    <link rel="stylesheet" href="{{asset("assets/css/auth_style.css")}}">


</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="toast bg-danger text-white m-4 hide" role="alert"
             style="position: absolute; top: 0; right:0;z-index: 10000" aria-live="assertive" aria-atomic="true"
             data-autohide="true"
             data-delay="10000"
             id="page-errors"
        >
            <div class="toast-header">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                        aria-label="Close">
                    <span aria-hidden="true" style="color: black !important;">×</span>
                </button>
            </div>
            <div class="toast-body">
                <strong style="text-align: right!important;" class="text-color-light"><i
                        class="fas fa-exclamation-triangle text-color-light mx-2"></i>خطا!</strong>
                <ul style="width: fit-content">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    @if(Session::has('error'))
                        <li> {{ Session::get('error') }}</li>
                    @endif
                </ul>
            </div>
        </div>

        @if(session()->has('status'))

            <div class="toast bg-success text-white m-4 hide" role="alert"
                 style="position: absolute; top: 0; right:0;z-index: 10000" aria-live="assertive" aria-atomic="true"
                 data-autohide="true"
                 data-delay="10000"
                 id="page-info"
            >
                <div class="toast-header">
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                            aria-label="Close">
                        <span aria-hidden="true" style="color: black !important;">×</span>
                    </button>
                </div>
                <div class="toast-body text-color-light"><i
                            class="fas fa-check text-color-light mx-2"></i>{{session('status')}}
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url({{asset("storage/images/login_image.jpg")}});">
                    </div>
                    <div class="login-wrap p-4 p-md-5">

                        <div class="d-flex">
                            <div class="w-100" align="center">
                                <img src="{{asset('storage/images/shirazu-logo.png')}}" style="width: 38%">
                                <h3 class="my-4">ورود</h3>
                            </div>
                        </div>
                        <form method="post" action="{{route('login')}}" class="signin-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="name">نام کاربری</label>
                                <input type="text" name="id" class="form-control" placeholder="شناسه یا ایمیل" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">کلمه عبور</label>
                                <input type="password" name="password" class="form-control" placeholder="کلمه عبور"
                                       required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                    ورود
                                </button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-right">
                                    <label class=" checkbox-primary mb-0">مرا به خاطر بسپار
                                        <input type="checkbox" style="margin-right: 10px" name="remember_me" checked>
                                    </label>
                                </div>
                                <div class="w-50 text-md-left">
                                    <a href="{{route('password.request')}}">فراموشی رمز</a>
                                </div>
                            </div>
                        </form>
                        <p class="text-center">عضو نیستید؟ <a href="{{route("register")}}">ثبت نام
                                کنید</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset("assets/vendor/popper/esm/popper.js")}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">

    (function ($) {

        "use strict";


    })(jQuery);


    @if ($errors->any() || \Illuminate\Support\Facades\Session::has('error'))
        $('#page-errors').toast('show');
    @endif

    @if(session()->has('status'))
        $('#page-info').toast('show');
    @endif
</script>

</body>
</html>

