<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <title>ثبت نام</title>
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("assets/css/app-light.css")}}" id="lightTheme">
    <link rel="shortcut icon" href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon">


    <link rel="stylesheet" href="{{asset("assets/vendor/bootstrap/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}">
    <style>
        @import url("{{asset("assets/css/farsi-fonts-styles/primary-dana.css")}}");
    </style>
    <link rel="stylesheet" href="{{asset("assets/css/auth_style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/feather.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/select2.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.steps.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.timepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/persianDatepicker-dark.css")}}">


    <!-- App CSS -->

    {{--    <link href="{{asset("assets/fontawesome/all.css")}}" rel="stylesheet">--}}

    <script src="https://kit.fontawesome.com/6cc8aa0555.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

    <style>
        body {
            text-align: right !important;
        }

        .select2-container--bootstrap4 .select2-selection--single {
            height: 48px !important;
        }
    </style>

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
                </ul>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url({{asset("storage/images/register_image.jpg")}});">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100" align="center">
                                <img src="{{asset('storage/images/shirazu-logo.png')}}" style="width: 38%">
                                <h3 class="my-4">ساخت حساب جدید</h3>
                            </div>
                        </div>
                        <form method="post" action="{{route('register')}}" class="signin-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="example-id">شماره دانشجویی</label>
                                <input type="text" id="example-id" name="std_num" class="form-control"
                                       required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for="validationCustom01">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="validationCustom01"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for="validationCustom02">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="validationCustom02"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="example-email">ایمیل</label>
                                <input type="email" id="example-email" name="email" class="form-control"
                                       placeholder="user@example.com" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for=store-password">کلمه عبور</label>
                                    <input type="password" name="password" id="store-password" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for="store-confirm-password">تکرار کلمه عبور</label>
                                    <input type="password" name="confirm_password" id="store-confirm-password"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for="update-birth-date">تاریخ تولد</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-date" id="store-birth-date"
                                               name="birth_date">

                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="label" for="simple-select2">رشته مربوطه</label>
                                    <select class="form-control select2" id="simple-select2" name="field_id">
                                        @foreach($fields as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                    ثبت نام
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="label" class=" checkbox-primary mb-0">مرا به خاطر بسپار
                                    <input type="checkbox" style="margin-right: 10px" name="remember_me" checked>
                                </label>
                            </div>
                        </form>
                        <p class="text-center">عضو هستید؟ <a href="{{route("login")}}">ورود</a></p>
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
<script src="{{asset("assets/js/persianDatepicker.min.js")}}"></script>
<script src="{{asset("assets/js/select2.min.js")}}"></script>

<script>

    (function ($) {

        "use strict";


    })(jQuery);
    $('.form-date').persianDatepicker({
        formatDate: "YYYY-MM-DD",
        theme: 'dark',
    });
    $('.select2').select2(
        {
            theme: 'bootstrap4',
        });
    $('.select2-multi').select2(
        {
            multiple: true,
            theme: 'bootstrap4',
        });

    @if ($errors->any())
    $('#page-errors').toast('show');
    @endif

</script>

</body>
</html>

