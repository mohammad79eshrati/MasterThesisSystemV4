<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">اساتید</x-slot>
    <div class="modal fade" id="addNewProfessor" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
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
                    <form method="post" action="{{route('professors.store')}}">
                        @csrf
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
                                    @foreach($departments as $d)
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
    <div class="modal fade" id="updateProfessor" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">ویرایش استاد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('professors.update')}}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <label for="update-prof-id">شناسه استاد</label>
                            <input type="text" id="update-prof-id" name="prof_id" class="form-control"
                                   hidden>
                            <input type="text" id="update-prof-id-show" class="form-control"
                                   disabled>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="update-first-name">نام</label>
                                <input type="text" name="first_name" class="form-control update-first-name"
                                       id="update-first-name"
                                       required>
                                <div class="valid-feedback"> Looks good!</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="update-last-name">نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-control update-last-name"
                                       id="update-last-name"
                                       required>
                                <div class="valid-feedback"> Looks good!</div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="update-email">ایمیل</label>
                            <input type="email" id="update-email" name="email" class="form-control update-email"
                                   placeholder="user@example.com" required>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="update-birth-date">تاریخ تولد</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-date"
                                           id="update-birth-date"
                                           aria-describedby="button-addon2" name="birth_date">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date"><span
                                                class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="update-department-select">بخش مربوطه</label>
                                <select class="form-control select2" id="update-department-select" name="department_id">
                                    @foreach($departments as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="number" name="user_id" class="form-control update-user-id"
                               id="update-user-id"
                               hidden>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn mb-2 btn-primary">ذخیره</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">آیا مطمئنید که می خواهید این استاد را حذف کنید؟</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">لغو</button>
                    <button type="button" class="btn mb-2 btn-danger" id="confirm-delete">حذف</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Striped rows -->
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-body">
                    <p class="h3 mb-4">اساتید</p>
                    <div class="toolbar row mb-3">
                        <div class="col">
                            <form class="form-inline">
                                <div class="form-row">
                                    <div class="form-group col-auto">
                                        <label for="search" class="sr-only">جستجو</label>
                                        <input type="text" class="form-control" id="datatable-search" value=""
                                               placeholder="جستجو">
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col ml-auto">
                            <div class="dropdown float-right">
                                <button class="btn btn-primary float-right ml-3" type="button" data-toggle="modal"
                                        data-target="#addNewProfessor">+ افزودن استاد جدید
                                </button>
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="actionMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">عملیات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                                    <a class="dropdown-item" href="#" id="switch-status"><i
                                            class="fe fe-16 fe-refresh-ccw"
                                            style="margin-left: 8px;position:relative;top:2px;"></i>تغییر وضعیت
                                        انتخاب شده ها
                                    </a>
                                    <a class="dropdown-item" href="#" id="multiple-delete" data-toggle="modal"
                                       data-target="#deleteModal"><i
                                            class="fe fe-16 fe-trash"
                                            style="margin-left: 8px;position:relative;top:2px;"></i>حذف انتخاب شده
                                        ها</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table -->
                    <table class="table table-bordered" id="professors-table">
                        <thead>

                        <tr role="row">
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-all">
                                    <label class="custom-control-label" for="checkbox-all"></label>
                                </div>
                            </th>
                            <th class="searchable">شناسه</th>
                            <th class="searchable">اسم</th>
                            <th class="searchable">سن</th>
                            <th class="searchable">ایمیل</th>
                            <th class="searchable">بخش</th>
                            <th class="searchable">وضعیت</th>
                            <th>عملیات</th>


                        </tr>

                        </thead>
                        <tbody>

                        @foreach($professors as $p)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox-each"
                                               id="{{$p->prof_id}}">
                                        <label class="custom-control-label" for="{{$p->prof_id}}"></label>
                                    </div>
                                </td>
                                <td class="update-prof-id">{{$p->prof_id}}</td>
                                <td><a style="color: inherit!important;"
                                       href="{{route('defenses.professor_index',$p)}}">{{$p->user->name()}}</a></td>
                                <td>{{date_diff(date_create($p->user->birth_date),date_create(gregorian_to_jalali(date('Y'), date('m'), date('d'),"Y-m-d")))->y }}</td>
                                <td class="update-email">{{$p->user->email}}</td>
                                <td>{{$p->department->name}}</td>
                                <td>
                                    @if($p->is_blocked === 1)
                                        <button type="button" class="btn mb-2 btn-danger" disabled>مسدود شده
                                        </button>
                                    @else
                                        <button type="button" class="btn mb-2 btn-success" disabled>در دسترس
                                        </button>
                                    @endif
                                </td>
                                <td>

                                    @if($p->is_blocked === 1)
                                        <form method="get" action="{{route('professors.unblock',$p->prof_id)}}"
                                              style="display: inline">
                                            <button type="submit" class="btn mb-2 btn-light"><span
                                                    class="fe fe-unlock fe-16"></span></button>
                                        </form>
                                    @else
                                        <form method="get" action="{{route('professors.block',$p->prof_id)}}"
                                              style="display: inline">
                                            <button type="submit" class="btn mb-2 btn-light"><span
                                                    class="fe fe-lock fe-16"></span></button>
                                        </form>
                                    @endif
                                    <span hidden class="update-first-name">{{$p->user->first_name}}</span>
                                    <span hidden class="update-last-name">{{$p->user->last_name}}</span>
                                    <span hidden class="update-birth-date">{{$p->user->birth_date}}</span>
                                    <span hidden class="update-user-id">{{$p->user->id}}</span>
                                    <span class="update-department-id" hidden>{{$p->department->id}}</span>
                                    <button type="button" class="btn mb-2 btn-light update-professor-btn align-center"
                                            data-toggle="modal"
                                            data-target="#updateProfessor"
                                            onclick="updateFunction(this)"><span
                                            class="fe fe-edit fe-16"></span></button>
                                    <form method="get" action="{{route('professors.delete',$p->prof_id)}}"
                                          style="display: inline">
                                        <button type="button" class="btn mb-2 btn-danger open-delete-modal"
                                                data-toggle="modal"
                                                data-target="#deleteModal"
                                                onclick="deleteFunction(this)"><span
                                                class="fe fe-trash-2 fe-16"></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- simple table -->
    </div> <!-- end section -->
    <form method="post" action="{{route('professors.multi_delete')}}" id="multi-delete-form">
        @csrf
    </form>
    <form method="post" action="{{route('professors.switch_status')}}" id="switch-status-form">
        @csrf
    </form>
</x-management-container>
<script type="text/javascript">
    function deleteFunction(btn) {
        let form = $(btn).parent();
        $("#confirm-delete").click(function () {
            form.submit();
        })
    }

    function updateFunction(btn) {
        $('#update-email').val($(btn).parent().parent().find($('.update-email')).html());
        $('#update-first-name').val($(btn).parent().find($('.update-first-name')).html());
        $('#update-last-name').val($(btn).parent().find($('.update-last-name')).html());
        // let bdate = new Date();
        // bdate = gregorian_to_jalali();
        $('#update-birth-date').val($(btn).parent().find($('.update-birth-date')).html());
        let userId = $(btn).parent().find($('.update-user-id')).html();
        $('#update-user-id').val(userId);
        let profId = $(btn).parent().parent().find($('.update-prof-id')).html();
        $("#update-prof-id").val(profId);
        $("#update-prof-id-show").val(profId);
        $('#update-department-select').val($(btn).parent().find($('.update-department-id')).html()).change();
    }


    table_init("professors-table");

    $("#multiple-delete").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.update-user-id').html();
                $("#multi-delete-form").append('<input type="number" name="' + i + '" value="' + id + '" hidden>');
                i += 1;
            }
        });
        let form = $("#multi-delete-form");
        $("#confirm-delete").click(function () {
            form.submit();
        })
    });

    $("#switch-status").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.update-user-id').html();
                $("#switch-status-form").append('<input type="number" name="' + i + '" value="' + id + '" hidden>');
                i += 1;
            }
        });
        $("#switch-status-form").submit();

    });



</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
