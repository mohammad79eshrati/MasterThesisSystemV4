<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot name="title">ساخت دفاع جدید</x-slot>
    <div class="toast fade bg-success text-white m-4 hide" role="alert"
         style="position: absolute; top: 0; right:0;z-index: 10000"
         aria-live="assertive" aria-atomic="true"
         data-autohide="true"
         data-delay="5000"
         id="successToast">
        <div class="toast-header">
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" data-bs-dismiss="toast"
                    aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">موضوع با موفقیت اضافه شد.</div>
    </div>
    <div class="toast fade bg-danger text-white m-4 hide" role="alert"
         style="position: absolute; top: 0; right:0;z-index: 10000" aria-live="assertive" aria-atomic="true"
         data-autohide="true"
         data-delay="5000"
         id="errorToast">
        <div class="toast-header">
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" data-bs-dismiss="toast"
                    aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body"></div>
    </div>
    @can('create',\App\Models\Subject::class)
        <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">افزودن موضوع جدید</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('subjects.store')}}" enctype="multipart/form-data"
                              id="add-subject-form">
                            @csrf
                            <input type="hidden" name="is_ajax" value="true" hidden>
                            <div class="form-group mb-3">
                                <label for="example-subject">نام موضوع</label>
                                <input type="text" id="example-subject" name="name" class="form-control"
                                       required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="subject-field-select2">رشته مربوطه</label>
                                <select class="form-control select2" id="subject-field-select2" name="field_id"
                                        style="width: 100%;">

                                    @foreach(\App\Models\Field::all() as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endforeach

                                </select>
                            </div> <!-- form-group -->
                            <div class="form-group mb-3">
                                <label for="example-fileinput">عکس مربوط به موضوع</label>
                                <input type="file" id="example-fileinput" name="subject-img" class="form-control-file"
                                >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn mb-2 btn-primary">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('create',\App\Models\Professor::class)
        <div class="modal fade" id="addProfessorModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">استاد جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('professors.store')}}" id="add-professor-form">
                            @csrf
                            <input type="hidden" name="is_ajax" value="true" hidden>
                            <div class="form-group mb-3">
                                <label for="prof-id">شناسه استاد</label>
                                <input type="text" id="prof-id" name="prof_id" class="form-control"
                                       required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstNameInputProf">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="firstNameInputProf"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastNameInputProf">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="lastNameInputProf"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="professor-email">ایمیل</label>
                                <input type="email" id="professor-email" name="email" class="form-control"
                                       placeholder="user@example.com" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for=store-password-prof">کلمه عبور</label>
                                    <input type="password" name="password" id="store-password-prof" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="store-confirm-password-prof">تکرار کلمه عبور</label>
                                    <input type="password" name="confirm_password" id="store-confirm-password-prof"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="update-birth-date">تاریخ تولد</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-date"
                                               name="birth_date">

                                        <div class="input-group-append">
                                            <div class="input-group-text"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department-select2">بخش مربوطه</label>
                                    <select class="form-control select2" id="department-select2" name="department_id">
                                        @foreach(\App\Models\Department::all() as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn mb-2 btn-primary">افزودن</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endcan
    @can('create',\App\Models\Student::class)
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">دانشجو جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('students.store')}}" id="add-student-form">
                            @csrf
                            <input type="hidden" name="is_ajax" value="true" hidden>

                            <div class="form-group mb-3">
                                <label for="std_num">شماره دانشجویی</label>
                                <input type="text" id="std_num" name="std_num" class="form-control"
                                       required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstNameInputStd">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="firstNameInputStd"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastNameInputStd">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="lastNameInputStd"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="student-email">ایمیل</label>
                                <input type="email" id="student-email" name="email" class="form-control"
                                       placeholder="user@example.com" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for=store-password-std">کلمه عبور</label>
                                    <input type="password" name="password" id="store-password-std" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="store-confirm-password-std">تکرار کلمه عبور</label>
                                    <input type="password" name="confirm_password" id="store-confirm-password-std"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="update-birth-date">تاریخ تولد</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-date"
                                               name="birth_date">

                                        <div class="input-group-append">
                                            <div class="input-group-text"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="field-select2">رشته مربوطه</label>
                                    <select class="form-control select2" id="field-select2" name="field_id"
                                            style="width: 100%">
                                        @foreach(\App\Models\Field::all() as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn mb-2 btn-primary">افزودن</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endcan
    <div class="container py-2">


        <div class="overflow-hidden mb-1">
            <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">معرفی</strong>
                دفاع جدید</h2>
        </div>


        <form class="contact-form" action="{{route('defenses.store')}}" method="POST">

            @csrf
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2">عنوان</label>
                    <input type="text" value="" data-msg-required="لطفا عنوان را وارد کنید."
                           class="form-control" name="title" required>
                </div>
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2" for="subject-select2">موضوع</label>

                    <div class="input-group">
                        <select class="form-control select2" id="subject-select2" name="subject_id">
                            @foreach($subjects as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                        @can('create',\App\Models\Subject::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text"
                                        data-toggle="modal"
                                        data-target="#addSubjectModal"><span
                                        class="fe fe-plus fe-16"></span></button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2">تاریخ برگزاری</label>
                    <input type="text" class="form-control form-date"
                           name="date" placeholder="تاریخ برگزاری را وارد کنید"
                           data-msg-required="لطفا تاریخ برگزاری را وارد کنید." required>
                </div>
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2">زمان برگزاری</label>
                    <div class="input-group clockpicker " data-align="top" data-placement="left"
                         data-autoclose="true">
                        <input type="text" class="form-control" style="height: 48px !important;" name="time"
                               placeholder="زمان برگزاری را وارد کنید">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label class="required font-weight-bold text-dark text-2">محل برگزاری</label>
                    <input type="text" class="form-control" id="store-place"
                           name="place" placeholder="محل برگزاری را وارد کنید" required>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input " name="is_online"
                           id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">برگزاری آنلاین</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2" for="professor-select2">استاد
                        راهنما</label>
                    <div class="input-group">
                        <select class="form-control select2" id="professor-select2" name="prof_id">
                            @if(\Illuminate\Support\Facades\Auth::user()->role === "professor")
                                <option
                                    value="{{\Illuminate\Support\Facades\Auth::user()->professor->prof_id}}">{{\Illuminate\Support\Facades\Auth::user()->professor->prof_id."- ".\Illuminate\Support\Facades\Auth::user()->professor->user->name()}}</option>
                            @else
                                @foreach($professors as $p)
                                    <option
                                        value="{{$p->prof_id}}">{{$p->prof_id."- ".$p->user->first_name." ".$p->user->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @can('create',\App\Models\Professor::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text"
                                        data-toggle="modal"
                                        data-target="#addProfessorModal"><span
                                        class="fe fe-plus fe-16"></span></button>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2" for="student-select2">دانشجو</label>
                    <div class="input-group">
                        <select class="form-control select2" id="student-select2" name="std_num">
                            @if(\Illuminate\Support\Facades\Auth::user()->role === "student")
                                <option
                                    value="{{\Illuminate\Support\Facades\Auth::user()->student->std_num}}">{{\Illuminate\Support\Facades\Auth::user()->student->std_num."- ".\Illuminate\Support\Facades\Auth::user()->student->user->name()}}</option>
                            @else
                                @foreach($students as $s)
                                    <option
                                        value="{{$s->std_num}}">{{$s->std_num."- ".$s->user->first_name.' '.$s->user->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @can('create',\App\Models\Student::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text"
                                        data-toggle="modal"
                                        data-target="#addStudentModal"><span
                                        class="fe fe-plus fe-16"></span></button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label class="font-weight-bold text-dark text-2 required">کلمات کلیدی</label>
                    <input type="text" value="" data-role="tagsinput"
                           class="form-control tagsinput" name="keywords" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label class="required font-weight-bold text-dark text-2">خلاصه</label>
                    <textarea rows="8" class="form-control" name="abstract" required hidden></textarea>
                    <div id="editor" style="min-height:100px;">

                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <input type="submit" value="ذخیره" class="btn btn-primary btn-modern"
                           data-loading-text="در حال بارگذاری ...">
                </div>
            </div>
        </form>


    </div>

</x-container>
<script type="text/javascript">


    $(document).ready(function () {

        var contents = $('.ql-editor').html();
        $('.ql-editor').blur(function () {
            console.log($(this).html());
            if (contents !== $(this).html()) {
                $("textarea[name=abstract]").html($(this).html());
            }
        });

        $('#add-subject-form').on('submit', (function (e) {
            e.preventDefault();
            $('#addSubjectModal').modal('toggle');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    let successToast = $("#successToast");
                    successToast.find($(".toast-body")).html("موضوع با موفقیت اضافه شد.");
                    successToast.toast("show");
                    $("#subject-select2").append(`
                        <option value="` + data.subject_id + `" selected>` + formData.get('name') + `</option>
                    `);
                },
                error: function (data) {
                    let toast = $("#errorToast");
                    toast.find($(".toast-body")).html(data.responseJSON.message);
                    toast.toast("show");

                }
            });
        }));
        $('#add-professor-form').on('submit', (function (e) {
            e.preventDefault();
            $('#addProfessorModal').modal('toggle');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    let successToast = $("#successToast");
                    successToast.find($(".toast-body")).html("استاد مورد نظر با موفقیت اضافه شد.");
                    successToast.toast("show");
                    $("#professor-select2").append(`
                        <option value="` + data.prof_id + `" selected>` + formData.get('prof_id') + "- " + formData.get('first_name') + " " + formData.get('last_name') + `</option>
                    `);
                },
                error: function (data) {
                    let toast = $("#errorToast");
                    toast.find($(".toast-body")).html(data.responseJSON.message);
                    toast.toast("show");

                }
            });
        }));
        $('#add-student-form').on('submit', (function (e) {
            e.preventDefault();
            $('#addStudentModal').modal('toggle');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    let successToast = $("#successToast");
                    successToast.find($(".toast-body")).html("دانشجوی مورد نظر با موفقیت اضافه شد.");
                    successToast.toast("show");
                    $("#student-select2").append(`
                        <option value="` + data.std_num + `" selected>` + formData.get('std_num') + "- " + formData.get('first_name') + " " + formData.get('last_name') + `</option>
                    `);
                },
                error: function (data) {
                    let toast = $("#errorToast");
                    toast.find($(".toast-body")).html(data.responseJSON.message);
                    toast.toast("show");

                }
            });
        }));
    });


</script>

