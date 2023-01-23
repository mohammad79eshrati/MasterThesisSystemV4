<!DOCTYPE html>
<html dir="rtl" class="side-header" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      style="height: 100% !important;">
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ $title ?? "SUDS" }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon">
    {{--    <link rel="stylesheet" href="{{asset("assets/css/typeahead.css")}}">--}}

    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">

{{--    <!-- Mobile Metas -->--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">--}}

    <link rel="stylesheet" href="{{asset("assets/css/app-light.css")}}" id="lightTheme">


    {{--    <link rel="stylesheet" href="{{asset("assets/css/auth_style.css")}}">--}}
    <link rel="stylesheet" href="{{asset("assets/css/feather.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/select2.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.steps.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.timepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/persianDatepicker-dark.css")}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{  asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/animate/animate.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/simple-line-icons/css/simple-line-icons.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/owl.carousel/assets/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/owl.carousel/assets/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/magnific-popup/magnific-popup.min.css") }}">
    <link rel="stylesheet" href="{{asset("assets/css/quill.snow.css")}}">


    <style>


        .image {
            background: url({{getProfileURL()}}) 50% 50% no-repeat; /* 50% 50% centers image in div */
            width: 160px;
            height: 160px;
        }

        #logo-container img:hover {
            width: 10vw !important;
            height: 10vw !important;
        }

        a h4:hover {
            color: #0099e6;
        }

        a:hover {
            text-decoration: none !important;
        }

        .popover-title {
            direction: ltr !important;
        }

        button {
            outline: none !important;
        }

        .sticky-top {
            position: sticky !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 900;
        }

        .sticky-right {
            position: sticky !important;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 900;
        }

        .absolute-bottom {
            position: absolute !important;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 900;
        }

        .post-image a img, .thumb-info {

            border-top-right-radius: 20px !important;
            border-top-left-radius: 20px !important;

        }

        .post-content, .thumb-info {

            border-bottom-left-radius: 20px !important;
            border-bottom-right-radius: 20px !important;

        }

        .dropdown-submenu {
            overflow-y: auto;
        }


    </style>


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/theme.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/theme-elements.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/theme-blog.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/theme-shop.css")}}">


    <!-- Current Page CSS -->
    <link rel="stylesheet"
          href="{{  asset("assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/clockpicker/dist/jquery-clockpicker.min.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/timepicker/bootstrap-timepicker.min.css") }}">

    <link rel="stylesheet" href="{{  asset("assets/vendor/rs-plugin/css/settings.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/rs-plugin/css/layers.css") }}">
    <link rel="stylesheet" href="{{  asset("assets/vendor/rs-plugin/css/navigation.css") }}">

    <!-- Demo CSS -->
    <link rel="stylesheet" type="text/css"
          href="{{asset("assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css")}}">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/skins/default.css")}}">

    <!-- Theme Custom CSS -->

    <!-- Head Libs -->
    <script src="{{asset("assets/vendor/modernizr/modernizr.min.js")}}"></script>


    <script src="https://kit.fontawesome.com/6cc8aa0555.js" crossorigin="anonymous"></script>
</head>
<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay
      data-plugin-options="{'hideDelay': 500}" style="height: 100%!important;">
<div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div class="body overflow-auto" style="height: 100% !important;">
    <div
        class="sticky-wrapper sticky-wrapper-transparent sticky-wrapper-effect-1 sticky-wrapper-border-bottom d-none d-lg-block d-xl-none"
        data-plugin-sticky data-plugin-options="{'minWidth': 0, 'stickyStartEffectAt': 100, 'padding': {'top': 0}}">
        <div class="sticky-body">
            <div class="tooltip  container-fluid">
                <div class="row align-items-center">
                    <div class="text-left" style="width: 100%!important;">
                        <button class="hamburguer-btn" data-set-active="false">
									<span class="hamburguer">
										<span></span>
										<span></span>
										<span></span>
									</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header id="header" class="side-header d-flex">
        <div class="header-body">
            <div class="header-container container d-flex h-100">
                <div class="header-column flex-row flex-lg-column justify-content-center h-100">
                    <div class="header-row justify-content-start h-100"
                         style="padding:0!important;">
                        <div class="header-logo" style="margin-bottom: 0!important;">
                            <a href="{{route('profile')}}" id="logo-container">
                                <img src="{{getProfileURL()}}" class="rounded-circle" style="width: 9vw; height: 9vw;"
                                     alt="profile image">
                            </a>
                            <a href="{{route('profile')}}">
                                <h4 class="hide-on-mobile"
                                    style="margin-bottom: 0!important;text-align: center;margin-top: 5px;">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</h4>
                                <p class="hide-on-mobile"
                                   style="text-align: center;">{{getPersianRole(\Illuminate\Support\Facades\Auth::user())}}</p>
                            </a>
                        </div>
                        <div
                            class="header-nav-features header-nav-features-no-border header-nav-features-md-show-border d-none d-md-inline-flex p-0 m-0">
                            <form role="search" action="{{route('defenses.fields_index')}}" method="get">
                                <div class="simple-search input-group w-auto">
                                    <input class="form-control text-1" id="headerSearch" name="q" type="search" value=""
                                           placeholder="جستجو ...">
                                    <span class="input-group-append">
													<button class="btn" type="submit">
														<i class="fa fa-search header-nav-top-icon"></i>
													</button>
												</span>
                                </div>
                            </form>
                        </div>
                        <div class="pt-4 header-row-side-header justify-content-start flex-row">
                            <div
                                class="header-nav header-nav-links header-nav-links-side-header header-nav-links-vertical header-nav-links-vertical-columns align-self-center">
                                <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li>
                                                <a class="dropdown-item
                                            @if(Route::getCurrentRoute()->getName() === "home")
                                            active
                                            @endif
                                            " href="{{route("home")}}">
                                                    خانه
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item
                                            @if(Route::getCurrentRoute()->getName() === "profile")
                                            active
                                            @endif
                                            " href="{{route("profile")}}">
                                                    پروفایل
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item
                                            @if(Route::getCurrentRoute()->getName() === "defenses.mine")
                                            active
                                            @endif
                                            " href="{{route("defenses.mine")}}">
                                                    دفاع های من
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item
                                            @if(Route::getCurrentRoute()->getName() === "interests")
                                            active
                                            @endif
                                            " href="{{route("interests")}}">
                                                    لیست علاقه مندی ها
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    بخش ها
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @foreach(\App\Models\Department::orderBy('name')->get()  as $d)
                                                        <li class="
                                                        @if(\App\Models\Field::where('department_id',$d->id)->first() !== null)
                                                            dropdown-submenu
                                                        @else
                                                            dropdown-item
                                                        @endif
                                                        "
                                                        >
                                                            <a class="dropdown-item"
                                                               href="{{route('defenses.department_index',$d)}}">{{ $d->name }}</a>
                                                            <ul class="dropdown-menu">
                                                                @foreach(\App\Models\Field::where('department_id',$d->id)->orderBy('name')->get() as $f)
                                                                    <li class="dropdown-submenu">
                                                                        <a class="dropdown-item "
                                                                           href="{{route('defenses.fields_index')}}#field-{{$f->id}}">{{$f->name}}</a>
                                                                        <ul class="dropdown-menu">

                                                                            <li><a class="dropdown-item"
                                                                                   href="{{route('defenses.fields_index')}}#field-{{$f->id}}">
                                                                                    نمایش تمام دفاع ها به صورت یکجا</a>
                                                                            </li>
                                                                            <li><a class="dropdown-item"
                                                                                   href="{{route('defenses.field_subjects',$f)}}">
                                                                                    دسته بندی موضوعات</a></li>
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                                                <li>
                                                    <a class="dropdown-item" href="{{route("management.home")}}">
                                                        مدیریت سایت
                                                    </a>
                                                </li>
                                            @endif

                                            <li>
                                                <a class="dropdown-item text-danger" href="{{route("logout")}}">
                                                    خروج
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="header-row justify-content-end pb-lg-3">
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                    data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">

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


        {{$slot}}


    </div>
    <footer id="footer">
        <div class="container">
            <div class="footer-ribbon">
                <span>در ارتباط باشید</span>
            </div>
            <div class="row py-5 justify-content-center">

                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <h5 class="text-3 mb-3">مطالب اخیر</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(\App\Models\Defense::whereIn('id',getRelatedDefenseIds(Auth::user()))->orderByDesc('created_at')->limit(3)->get() as $d)
                            <li class="media mb-3 pb-1">
                                <article class="d-flex">
                                    <a href="{{route('defenses.show',$d)}}">
                                        <img class="mr-3 rounded-circle square-element"
                                             src="{{getSubjectImagePath($d->subject)}}"
                                             alt=""
                                             style="max-width: 70px;">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('defenses.show',$d)}}">
                                            <h6 class="text-1em text-color-light opacity-8 ls-0 mb-1 primary-font">{{$d->title}}</h6>
                                            <p class="text-2 mb-0 persian-datetime">{{jalali_to_gregorian($d->date,"Y-m-d")." ".$d->time}}</p>
                                        </a>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                    <h5 class="text-3 mb-3">موضوع ‌های جدید</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(\App\Models\Subject::whereIn('id',getRelatedSubjectIds(\Illuminate\Support\Facades\Auth::user()))->orderByDesc('created_at')->limit(5)->get() as $s)
                            <li class="mb-3 pb-1">
                                <a href="{{route('defenses.subject_index',$s)}}">
                                    <p class="text-1em text-color-primary opacity-8 mb-1"><i
                                            class="fas fa-angle-left text-color-primary align-middle mx-3"></i>
                                        {{$s->name}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h5 class="text-3 mb-3">کلمات کلیدی پرکابرد</h5>
                    <p class="mb-2">
                        @foreach(\App\Models\Keyword::withCount('defenses')->orderByDesc('defenses_count')->limit(15)->get() as $k )
                            <a href="{{route('defenses.keyword_index',$k)}}"><span
                                    class="badge badge-dark bg-color-black badge-sm py-2 mr-1 mb-2 text-uppercase">{{strtoupper($k->name)}}</span></a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </footer>


</div>

<!-- Vendor -->


<script src="{{  asset("assets/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.appear/jquery.appear.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.easing/jquery.easing.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.cookie/jquery.cookie.min.js")}}"></script>
<script src="{{  asset("assets/vendor/popper/umd/popper.min.js")}}"></script>
<script src="{{  asset("assets/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{  asset("assets/vendor/common/common.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.validation/jquery.validate.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.gmap/jquery.gmap.min.js")}}"></script>
<script src="{{  asset("assets/vendor/jquery.lazyload/jquery.lazyload.min.js")}}"></script>
<script src="{{  asset("assets/vendor/isotope/jquery.isotope.min.js")}}"></script>
<script src="{{  asset("assets/vendor/owl.carousel/owl.carousel.min.js")}}"></script>
<script src="{{  asset("assets/vendor/magnific-popup/jquery.magnific-popup.min.js")}}"></script>
<script src="{{  asset("assets/vendor/vide/jquery.vide.min.js")}}"></script>
<script src="{{  asset("assets/vendor/vivus/vivus.min.js")}}"></script>
<script src="{{asset("assets/js/persianDatepicker.min.js")}}"></script>
<script src="{{asset("assets/js/select2.min.js")}}"></script>
<script src="{{asset("assets/js/quill.min.js")}}"></script>


<!-- Theme Base, Components and Settings -->
<script src="{{  asset("assets/js/theme.js")}}"></script>

<!-- Current Page Vendor and Views -->
<script src="{{  asset("assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js")}}"></script>
<script src="{{  asset("assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js")}}"></script>

<!-- Clock Plugin JavaScript -->
<script src="{{asset("assets/vendor/moment/moment.js")}}"></script>
<script src="{{asset("assets/vendor/clockpicker/dist/jquery-clockpicker.min.js")}}"></script>
<script src="{{asset("assets/vendor/timepicker/bootstrap-timepicker.min.js")}}"></script>
<script
    src="{{asset("assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")}}"></script>

<!-- Theme Custom -->
<script src="{{  asset("assets/js/typeahead.bundle.js")}}"></script>
<script src="{{  asset("assets/js/custom.js")}}"></script>

{{--<!-- Theme Initialization Files ->--}}
<script src="{{  asset("assets/js/theme.init.js")}}"></script>
<script src="{{  asset("assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js")}}"></script>

<!-- Examples -->
{{--<script src="{{  asset("assets/vendor/vivus/vivus.min.js")}}"></script>--}}
{{--<script src="js/examples/examples.portfolio.js"></script>--}}

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-12345678-1', 'auto');
    ga('send', 'pageview');
</script>
 -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.square-element').each(function () {
            let dis = $(this);
            dis.css('height', dis.css('width'));
            dis.find($('img')).css('height', dis.find('img').css('width'));
        });

        $(window).on('resize', function () {
            $('.square-element').each(function () {
                let dis = $(this);
                dis.css('height', dis.css('width'));
                dis.find($('img')).css('height', dis.find('img').css('width'));
            });
        });

    });
    var editor = document.getElementById('editor');
    if (editor) {
        var toolbarOptions = [
            [
                {
                    'font': []
                }],
            [
                {
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [
                {
                    'header': 1
                },
                {
                    'header': 2
                }],
            [
                {
                    'list': 'ordered'
                },
                {
                    'list': 'bullet'
                }],
            [
                {
                    'script': 'sub'
                },
                {
                    'script': 'super'
                }],
            [
                {
                    'indent': '-1'
                },
                {
                    'indent': '+1'
                }], // outdent/indent
            [
                {
                    'direction': 'rtl'
                }], // text direction
            [
                {
                    'color': []
                },
                {
                    'background': []
                }], // dropdown with defaults from theme
            [
                {
                    'align': []
                }],
            ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor,
            {
                modules:
                    {
                        toolbar: toolbarOptions
                    },
                theme: 'snow'
            });
    }
    (function ($) {
        "use strict"
        $('#timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            time: true,
            date: false
        });

        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'right',
            autoclose: true,
            default: 'now',
        });

    })(jQuery);


    $('.form-date').persianDatepicker({
        formatDate: "YYYY-0M-0D",
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

    $keywords = [@foreach(\App\Models\Keyword::all() as $k)
        "{{$k->name}}",
        @endforeach]
    var tags = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: $.map($keywords, function (tag) {
            return {
                name: tag
            };
        })

    });
    tags.initialize();
    $('.tagsinput').tagsinput({
        typeaheadjs: {
            name: 'tags',
            displayKey: 'name',
            valueKey: 'name',
            source: tags.ttAdapter()
        }
    });

    $(".persian-datetime").each(function () {
        let d = new Date($(this).html());
        $(this).html(d.toLocaleString('fa', {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit"
        }));
    });

    $('.timepicker').timepicker({
        defaultTime: 'now',
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian: false
    });

    @if ($errors->any())
    $('#page-errors').toast('show');
    @endif

</script>

</body>
</html>
