<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
    <meta name="_token" content="{!! csrf_token() !!}"/>
    {{--    <link rel="icon" href="favicon.ico">--}}
    <title>مدیریت - {{$title ?? "SUDS"}}</title>
    <link rel="shortcut icon" href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon">


    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/simplebar.css")}}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/feather.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/select2.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dropzone.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/uppy.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.steps.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/jquery.timepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/quill.snow.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/persianDatepicker-dark.css")}}">


    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/app-light.css")}}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{asset("assets/css/app-dark.css")}}" id="darkTheme">

    {{--    <link href="{{asset("assets/fontawesome/all.css")}}" rel="stylesheet">--}}

    <script src="https://kit.fontawesome.com/6cc8aa0555.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
    <style>

        td, th {
            text-align: center !important;
        }

        i, span {
            vertical-align: middle !important;
        }

        .fixed-top {
            position: sticky;
        }

        @media (max-width: 768px) {
            .fixed-top {
                position: static;
            }
        }

        .image {

            background: url({{getProfileURL()}}) 50% 50% no-repeat; /* 50% 50% centers image in div */
            width: 32px;
            height: 32px;
            vertical-align: middle;
            display: inline-block !important;
        }

        .nav-link.active {
            color: #3a7bfa !important;
        }

    </style>

</head>
<body class="vertical dark rtl">
<div class="wrapper">
    <nav class="topnav navbar navbar-light  fixed-top bg-white" id="top-nav">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
            <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                    <i class="fe fe-sun fe-16"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" align="center">
              <span class="avatar avatar-sm mt-2">
{{--                  <div src="{{getProfileURL()}}" alt="..." class="avatar-img rounded-circle image"--}}
                  {{--                       style="display: flex"></div>--}}
                  <img src="{{getProfileURL()}}" class="rounded-circle"
                       style="width: 40px !important;height: 40px !important"
                       alt="profile image">
              </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{route("profile")}}">پروفایل</a>
                    <a class="dropdown-item text-danger" href="{{route("logout")}}">خروج</a>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('management.home')}}">
                    <img src="{{ asset('storage/images/shirazu-logo.svg')}}"
                         class="navbar-brand-img brand-md">
                </a>
            </div>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item">
                    <a href="{{route("management.home")}}" class="nav-link

                    @if(Route::getCurrentRoute()->getName() === "management.home")
                        active
                    @endif

                    ">
                        <i class="fa fa-home fa-16 fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">خانه</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("home")}}" class="nav-link">
                        <i class="fa fa-earth-asia fa-16 fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">وبسایت</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link"
                       id="users-dropdown">
                        <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">کاربران</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                        <li class="nav-item">
                            <a class="nav-link pl-3
                            @if(Route::getCurrentRoute()->getName() === "admins")
                                active
                            @endif
                            " href="{{route('admins')}}"><span
                                    class="ml-1 item-text">ادمین ها</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3
                            @if(Route::getCurrentRoute()->getName() === "professors")
                                active
                            @endif
                            " href="{{route("professors")}}"><span
                                    class="ml-1 item-text">اساتید</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3
                            @if(Route::getCurrentRoute()->getName() === "students")
                                active
                            @endif
                            " href="{{route('students')}}"><span
                                    class="ml-1 item-text">دانشجویان</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route("departments")}}" class="nav-link
                    @if(Route::getCurrentRoute()->getName() === "departments")
                        active
                    @endif
                    ">
                        <i class="fa fa-building fa-lg fa-fw" aria-hidden="true" style="width:16px!important;"></i>
                        <span class="ml-3 item-text">بخش ها</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("fields")}}" class="nav-link
                    @if(Route::getCurrentRoute()->getName() === "fields")
                        active
                    @endif
                    ">
                        <i class="fa fa-graduation-cap fa-fw" aria-hidden="true"
                        ></i>
                        <span class="ml-3 item-text">رشته ها</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("subjects")}}" class="nav-link
                    @if(Route::getCurrentRoute()->getName() === "subjects")
                        active
                    @endif
                    ">
                        <i class="fa fa-book fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">موضوع ها</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("defenses")}}" class="nav-link
                    @if(Route::getCurrentRoute()->getName() === "defenses")
                        active
                    @endif
                    ">
                        <i class="fa fa-shield fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">دفاع ها</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("keywords")}}" class="nav-link
                    @if(Route::getCurrentRoute()->getName() === "keywords")
                        active
                    @endif
                    ">
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="ml-3 item-text">کلمات کلیدی</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("logout")}}" class="nav-link text-danger">
                        <i class="fas fa-sign-out"></i>
                        <span class="ml-3 item-text">خروج</span>
                    </a>
                </li>
            </ul>

        </nav>
    </aside>
    <main role="main" class="main-content">
        <div class="toast fade bg-danger text-white m-4 hide" role="alert"
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
        {{ $slot }}
    </main> <!-- main -->
</div> <!-- .wrapper -->


<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/js/persianDatepicker.min.js")}}"></script>

<script src="{{asset("assets/js/popper.min.js")}}"></script>
<script src="{{asset("assets/js/moment.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/js/simplebar.min.js")}}"></script>
<script src="{{asset("assets/js/daterangepicker.js")}}"></script>
<script src="{{asset("assets/js/jquery.stickOnScroll.js")}}"></script>
<script src="{{asset("assets/js/tinycolor-min.js")}}"></script>
<script src="{{asset("assets/js/config.js")}}"></script>
<script src="{{asset("assets/js/d3.min.js")}}"></script>
<script src="{{asset("assets/js/topojson.min.js")}}"></script>
<script src="{{asset("assets/js/datamaps.all.min.js")}}"></script>
<script src="{{asset("assets/js/datamaps-zoomto.js")}}"></script>
<script src="{{asset("assets/js/datamaps.custom.js")}}"></script>
<script src="{{asset("assets/js/Chart.min.js")}}"></script>
{{--<script>--}}
{{--    /* defind global options */--}}
{{--    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;--}}
{{--    Chart.defaults.global.defaultFontColor = colors.mutedColor;--}}
{{--</script>--}}

<script src="{{asset("assets/js/gauge.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.sparkline.min.js")}}"></script>
<script src="{{asset("assets/js/apexcharts.min.js")}}"></script>
<script src="{{asset("assets/js/apexcharts.custom.js")}}"></script>
<script src="{{asset("assets/js/jquery.mask.min.js")}}"></script>
<script src="{{asset("assets/js/select2.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.steps.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.validate.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.timepicker.js")}}"></script>
<script src="{{asset("assets/js/dropzone.min.js")}}"></script>
<script src="{{asset("assets/js/uppy.min.js")}}"></script>
<script src="{{asset("assets/js/quill.min.js")}}"></script>
<script src="{{asset("https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js")}}"></script>

<script>
    $("#modeSwitcher").click(function () {
        let nav = $('#top-nav')
        if (nav.hasClass('bg-dark')) {
            nav.removeClass('bg-dark');
            nav.addClass('bg-light');
        } else if (nav.hasClass('bg-light')) {
            nav.removeClass('bg-light');
            nav.addClass('bg-dark');
        }
    });


    function table_init(table_id) {
        $('#' + table_id + ' thead th').each(function () {
            if ($(this).find($('input[type=checkbox]')).length === 0 && $(this).hasClass('searchable')) {
                $(this).append('<br><input type="text" class="form-control" style="margin: 8px auto 0 auto;height:20px;width:70%;" placeholder="جستجو"/>');
            }
        });
        var table = $('#' + table_id).DataTable(
            {
                autoWidth: true,
                "dom": '<"top"l>rt<"bottom"p><"clear">',
                // "ordering": true,
                // "searching": true,
                // "lengthChange": false,
                // "info": false,
                // "paging": true,
                // "pagingType": "simple",
                //
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "همه"]
                ],
                "language": {
                    "search": "_INPUT_",            // Removes the 'Search' field label
                    "searchPlaceholder": "جستجو",  // Placeholder for the search box
                    emptyTable: "موردی وجود ندارد",
                    "paginate": {
                        'previous': "قبلی",
                        'next': "بعدی"
                    },
                    zeroRecords: "هیچ رکوردی یافت نشد",
                    sLengthMenu: "_MENU_",

                },


            });
        table.columns().every(function () {
            var that = this;
            $('input', this.header()).on('keyup change clear', function (e) {
                // preventDefault(e);
                if (that.search() !== this.value && $(this).attr('type') !== 'checkbox') {
                    that.search(this.value).draw();
                }

            });
            $('input', this.header()).click(function (e) {
                if ($(this).attr('type') !== 'checkbox') {
                    return false;
                }
            });
        });
        let kl = $(".dataTables_length").find($('select'));
        kl.removeClass('form-select', 'form-select-sm');
        kl.addClass('custom-select mr-sm-2');

        $('#datatable-search').keyup(function () {
            table.search($(this).val()).draw();
        });

        $('.open-delete-modal').click(function () {
            let form = $(this).parent();
            $("#confirm-delete").click(function () {
                form.submit();
            })
        })


        $('#checkbox-all').click(function () {
            $(".checkbox-each").prop('checked', !!$(this).is(":checked"));

        });
        $(".checkbox-each").click(function () {
            if (!$(this).is(":checked")) {
                $("#checkbox-all").prop('checked', false);
            } else {
                let flag = true;
                $(".checkbox-each").each(function () {
                    if (!$(this).is(":checked")) {
                        flag = false;
                    }
                });
                $("#checkbox-all").prop('checked', flag);


            }
        })
    }


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
    $('.drgpicker').daterangepicker(
        {
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale:
                {
                    format: 'MM/DD/YYYY'
                }
        });
    $('.time-input').timepicker(
        {
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker(
            {
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale:
                    {
                        format: 'M/DD hh:mm A'
                    }
            });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges:
                {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
        }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000",
        {
            placeholder: "__/__/____"
        });
    $('.input-zip').mask('00000-000',
        {
            placeholder: "____-___"
        });
    $('.input-money').mask("#.##0,00",
        {
            reverse: true
        });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
        {
            translation:
                {
                    'Z':
                        {
                            pattern: /[0-9]/,
                            optional: true
                        }
                },
            placeholder: "___.___.___.___"
        });
    // editor
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
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg) {
        var uppy = Uppy.Core().use(Uppy.Dashboard,
            {
                inline: true,
                target: uptarg,
                proudlyDisplayPoweredByUppy: false,
                theme: 'dark',
                width: 770,
                height: 210,
                plugins: ['Webcam']
            }).use(Uppy.Tus,
            {
                endpoint: 'https://master.tus.io/files/'
            });
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    }
</script>
<script src="{{asset("assets/js/apps.js")}}"></script>
<!-- Global site tag (gtag.js)) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
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

        @if(Route::getCurrentRoute()->getName() === "admins" ||
            Route::getCurrentRoute()->getName() === "students" ||
            Route::getCurrentRoute()->getName() ===  "professors")
        $('#users-dropdown').dropdown('toggle');
        @endif
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

    @if ($errors->any())
    $('#page-errors').toast('show');
    @endif


</script>
</body>
</html>
