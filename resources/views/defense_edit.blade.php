<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">ویرایش دفاع</x-slot>
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
                                <label for="simple-select2">رشته مربوطه</label>
                                <select class="form-control select2" id="simple-select2" name="field_id"
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
                                <label for="example-id">شناسه استاد</label>
                                <input type="text" id="example-id" name="prof_id" class="form-control"
                                       required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="validationCustom01"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="validationCustom02"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="example-email">ایمیل</label>
                                <input type="email" id="example-email" name="email" class="form-control"
                                       placeholder="user@example.com" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for=store-password">کلمه عبور</label>
                                    <input type="password" name="password" id="store-password" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="store-confirm-password">تکرار کلمه عبور</label>
                                    <input type="password" name="confirm_password" id="store-confirm-password"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="update-birth-date">تاریخ تولد</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-date" id="store-birth-date"
                                               name="birth_date">

                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="simple-select2">بخش مربوطه</label>
                                    <select class="form-control select2" id="simple-select2" name="department_id">
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
                                <label for="example-id">شماره دانشجویی</label>
                                <input type="text" id="example-id" name="std_num" class="form-control"
                                       required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">نام</label>
                                    <input type="text" name="first_name" class="form-control" id="validationCustom01"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" id="validationCustom02"
                                           required>
                                    <div class="valid-feedback"> Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="example-email">ایمیل</label>
                                <input type="email" id="example-email" name="email" class="form-control"
                                       placeholder="user@example.com" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for=store-password">کلمه عبور</label>
                                    <input type="password" name="password" id="store-password" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="store-confirm-password">تکرار کلمه عبور</label>
                                    <input type="password" name="confirm_password" id="store-confirm-password"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="update-birth-date">تاریخ تولد</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-date" id="store-birth-date"
                                               name="birth_date">

                                        <div class="input-group-append">
                                            <div class="input-group-text" id="button-addon-date"><span
                                                    class="fe fe-calendar fe-16"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="simple-select2">رشته مربوطه</label>
                                    <select class="form-control select2" id="simple-select2" name="field_id"
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


        <form class="contact-form" action="{{route('defenses.update',$defense->id)}}" method="POST">

            @csrf
            @method('put')
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2">عنوان</label>
                    <input type="text" value="{{$defense->title}}" data-msg-required="لطفا عنوان را وارد کنید."
                           class="form-control" name="title" required>
                </div>
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2" for="subject-select2">موضوع</label>
                    <div class="input-group">
                        <select class="form-control select2" id="subject-select2" name="subject_id">
                            @foreach(\App\Models\Subject::all() as $s)
                                @if($s->id === $defense->subject_id)
                                    <option value="{{$s->id}}" selected>{{$s->name}}</option>
                                @else
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @can('create',\App\Models\Subject::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text" id="button-addon-date"
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
                    <input type="text" class="form-control form-date" id="store-birth-date"
                           name="date" placeholder="تاریخ برگزاری را وارد کنید"
                           data-msg-required="لطفا تاریخ برگزاری را وارد کنید." value="{{$defense->date}}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2">زمان برگزاری</label>
                    <div class="input-group clockpicker " data-align="top" data-placement="left"
                         data-autoclose="true">
                        <input type="text" class="form-control" style="height: 48px !important;" name="time"
                               placeholder="زمان برگزاری را وارد کنید" value="{{substr($defense->time,0,-3)}}">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label class="required font-weight-bold text-dark text-2">محل برگزاری</label>
                    <input type="text" class="form-control" id="store-place"
                           name="place" placeholder="محل برگزاری را وارد کنید" value="{{$defense->place}}" required>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <div class="custom-control custom-switch">

                    @if($defense->is_online)
                        <input type="checkbox" class="custom-control-input " name="is_online"
                               id="customSwitch1" checked>
                    @else
                        <input type="checkbox" class="custom-control-input " name="is_online"
                               id="customSwitch1">
                    @endif
                    <label class="custom-control-label" for="customSwitch1">برگزاری آنلاین</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label class="required font-weight-bold text-dark text-2" for="professor-select2">استاد
                        راهنما</label>
                    <div class="input-group">
                        <select class="form-control select2" id="professor-select2" name="prof_id">
                            @foreach(\App\Models\Professor::all() as $p)
                                @if($p->prof_id == $defense->prof_id)
                                    <option
                                        value="{{$p->prof_id}}"
                                        selected>{{$p->prof_id."- ".$p->user->name()}}</option>
                                @else
                                    <option
                                        value="{{$p->prof_id}}">{{$p->prof_id."- ".$p->user->name()}}</option>
                                @endif

                            @endforeach
                        </select>
                        @can('create',\App\Models\Professor::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text" id="button-addon-date"
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
                            @foreach(\App\Models\Student::all() as $s)
                                @if($s->std_num == $defense->std_num)
                                    <option
                                        value="{{$s->std_num}}"
                                        selected>{{$s->std_num."- ".$s->user->name()}}</option>
                                @else
                                    <option
                                        value="{{$s->std_num}}">{{$s->std_num."- ".$s->user->name()}}</option>
                                @endif
                            @endforeach
                        </select>
                        @can('create',\App\Models\Student::class)
                            <div class="input-group-append">
                                <button type="button" class="input-group-text" id="button-addon-date"
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
                    <input type="text" value="
                    @foreach($defense->keywords as $k)
                        {{$k->name}},
                    @endforeach
                    " data-role="tagsinput"
                           class="form-control tagsinput" name="keywords" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label class="required font-weight-bold text-dark text-2">خلاصه</label>
                    <textarea rows="8" class="form-control" name="abstract" required
                              hidden>{{$defense->abstract}}</textarea>
                    <div id="editor" style="min-height:100px;">
                        {!! $defense->abstract !!}
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
                        <option value="` + data.subject_id + `" selected >` + formData.get('name') + `</option>
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
                        <option value="` + data.prof_id + `" selected >` + formData.get('prof_id') + "- " + formData.get('first_name') + " " + formData.get('last_name') + `</option>
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
                        <option value="` + data.std_num + `" selected >` + formData.get('std_num') + "- " + formData.get('first_name') + " " + formData.get('last_name') + `</option>
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


