<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">پروفایل کاربر</x-slot>
    <section class="page-header page-header-classic">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home')}}">خانه</a></li>
                        <li class="active">پروفایل کاربر</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col p-static mt-1 mb-n1">
                    <h1 data-title-border>پروفایل کاربر</h1>
                </div>
            </div>
        </div>
    </section>
    <form role="form" method="post"
          action="{{route('update_profile',Auth::id())}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container py-2">

            <div class="row">
                <div class="col-lg-3 mt-4 mt-lg-0">

                    <div class="d-flex justify-content-center mb-4">
                        <div class="profile-image-outer-container">
                            <div class="profile-image-inner-container bg-color-primary">
                                <img src="{{getProfileURL()}}" id="profile-image">
                                <span class="profile-image-button bg-color-dark">
											<i class="fas fa-camera text-light"></i>
										</span>
                            </div>
                            <input type="file" name="profile_img" id="profile-input"
                                   class="profile-image-input">
                        </div>
                    </div>


                </div>
                <div class="col-lg-9">

                    <div class="overflow-hidden mb-1">
                        <h2 class="font-weight-normal text-7 mb-0"><strong
                                class="font-weight-extra-bold">پروفایل</strong>
                            من</h2>
                    </div>

                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">شناسه</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="id"
                                   value="{{Auth::user()->getUserId()}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">نام</label>
                        <div class="col-lg-9">
                            <input class="form-control" required type="text" name="first_name"
                                   value="{{Auth::user()->first_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">نام
                            خانوادگی</label>
                        <div class="col-lg-9">
                            <input class="form-control" required type="text" name="last_name"
                                   value="{{Auth::user()->last_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">ایمیل</label>
                        <div class="col-lg-9">
                            <input class="form-control text-left" required type="email" name="email"
                                   value="{{Auth::user()->email}}"
                                   dir="ltr">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">تاریخ
                            تولد</label>

                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="text" class="form-control form-date" id="store-birth-date"
                                       name="birth_date" value="{{Auth::user()->birth_date}}">

                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">شماره
                            تلفن</label>
                        <div class="col-lg-9">
                            <input class="form-control text-left" required type="text" name="phone"
                                   value="{{Auth::user()->phone}}"
                                   dir="ltr">
                        </div>
                    </div>
                    <div class="row">
                        <label
                            class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2"></label>
                        <div class="form-group col-lg-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input " name="phone_notif"
                                       id="customSwitch1"
                                       @if(\Illuminate\Support\Facades\Auth::user()->phone_notif)
                                           checked
                                    @endif
                                >
                                <label class="custom-control-label" for="customSwitch1">ارسال دفاع ها به شماره</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input " name="email_notif"
                                       id="customSwitch2"
                                       @if(\Illuminate\Support\Facades\Auth::user()->email_notif)
                                           checked
                                    @endif
                                >
                                <label class="custom-control-label" for="customSwitch2">ارسال دفاع ها به ایمیل</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" align="left">

                        <input type="submit" value="ذخیره"
                               class="btn btn-primary btn-modern align-left"
                               data-loading-text="در حال بارگذاری ...">
                    </div>

                </div>
            </div>

        </div>
    </form>

</x-container>

<script type="text/javascript">
    // document.getElementById('profile-input').onchange = function (evt) {
    //     var tgt = evt.target || window.event.srcElement,
    //         files = tgt.files;
    //
    //     // FileReader support
    //     if (FileReader && files && files.length) {
    //         var fr = new FileReader();
    //         fr.onload = function () {
    //             document.getElementById("profile-image").src = fr.result;
    //         }
    //         fr.readAsDataURL(files[0]);
    //     }
    //
    //     // Not supported
    //     else {
    //         // fallback -- perhaps submit the input to an iframe and temporarily store
    //         // them on the server until the user's session ends.
    //     }
    // }

    $("#profile-input").change(function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profile-image').src = this.result;
        };
        reader.readAsDataURL(file);
        console.log("changing pic")
    })

</script>
