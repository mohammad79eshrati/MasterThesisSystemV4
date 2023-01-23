<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">موضوعات</x-slot>
    <div class="modal fade" id="addNewsubject" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">موضوع جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('subjects.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="example-subject">نام موضوع</label>
                            <input type="text" id="example-subject" name="name" class="form-control"
                                   required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="simple-select2">رشته مربوطه</label>
                            <select class="form-control select2" id="simple-select2" name="field_id">
                                @foreach($fields as $d)
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
    <div class="modal fade" id="updatesubject" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">ویرایش موضوع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('subjects.update')}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group mb-3">
                            <label for="update-name">نام</label>
                            <input type="text" id="update-name" name="name" class="form-control"
                                   required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="update-field-select">رشته مربوطه</label>
                            <select class="form-control select2" id="update-field-select" name="field_id">
                                @foreach($fields as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <img id="update-modal-image" style="max-width: 100%;max-height: 100%;" src=""
                                     alt="عکسی برای این موضوع انتخاب نشده">
                            </div><!-- form-group -->
                            <div class="col-md-6 mb-3">
                                <label for="example-fileinput">انتخاب عکس جدید</label>
                                <input type="file" id="example-fileinput" name="subject-img" class="form-control-file"
                                >
                            </div>
                        </div>
                        <input type="number" name="subject_id" class="form-control "
                               id="update-subject-id"
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
                    <h5 class="modal-title" id="verticalModalTitle">آیا مطمئنید که می خواهید این موضوع را حذف کنید؟</h5>
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
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <img id="modal-img" style=" max-width:100%;max-height:100%;" src="#" alt="عکسی برای این موضوع انتخاب نشده">
                </div>

            </div>
        </div>
    </div>
    <div class="row">

        <!-- Striped rows -->
        <div class="col-md-12 my-4">
            <div class="card shadow">
                <div class="card-body">
                    <p class="h3 mb-4">موضوعات</p>

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
                                        data-target="#addNewsubject">+ افزودن موضوع جدید
                                </button>
                                <button class="btn btn-danger" type="button"
                                        aria-expanded="false" data-toggle="modal"
                                        data-target="#deleteModal">
                                    <a class="form-control btn-danger" href="#"
                                       id="multiple-delete"
                                       style="padding:0!important;display: inline!important;"><i
                                            class="fe fe-16 fe-trash"
                                            style="margin-left: 8px;"></i>حذف انتخاب شده
                                        ها</a>
                                </button>

                            </div>
                        </div>
                    </div>
                    <!-- table -->
                    <table class="table table-bordered datatables" id="subjects-table">
                        <thead>

                        <tr role="row">
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-all">
                                    <label class="custom-control-label" for="checkbox-all"></label>
                                </div>
                            </th>
                            <th class="searchable">شناسه</th>
                            <th class="searchable"> اسم</th>
                            <th class="searchable">رشته مربوطه</th>
                            <th class="searchable">تاریخ ایجاد</th>

                            <th>عملیات</th>


                        </tr>

                        </thead>
                        <tbody>

                        @foreach($subjects as $s)
                            <tr>
                                <td>
                                    <div class=" custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox-each"
                                               id="{{$s->id}}">
                                        <label class="custom-control-label" for="{{$s->id}}"></label>
                                    </div>
                                </td>
                                <td class="update-subject-id">{{$s->id}}</td>
                                <td ><a style="color: inherit!important;" class="update-name"
                                                           href="{{route('defenses.subject_index',$s->id)}}">{{$s->name}}</a>
                                </td>
                                <td><a style="color: inherit!important;"
                                       href="{{route('defenses.field_subjects',$s->field)}}">{{$s->field->name}}</a>
                                </td>
                                <td class="persian-datetime">{{$s->created_at}}</td>
                                <td>
                                    <span class="update-field-id" hidden>{{$s->field->id}}</span>
                                    <button type="button" class="btn mb-2 btn-light update-subject-btn"
                                            data-toggle="modal"
                                            data-target="#updatesubject"
                                            onclick="updateFunction(this)"><span
                                            class="fe fe-edit fe-16"></span></button>

                                    <span class="img-link" hidden>{{ asset('storage/images/'.$s->image_name) }}</span>
                                    <button type="button" class="btn mb-2 btn-light open-image-modal"
                                            data-toggle="modal"
                                            data-target="#imageModal"
                                            onclick="openImageModal(this)"><span
                                            class="fe fe-image fe-16"></span></button>
                                    <form method="get" action="{{route('subjects.delete',$s->id)}}"
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
    <form method="post" action="{{route('subjects.multi_delete')}}" id="multi-delete-form">
        @csrf
    </form>
    {{--    <form method="post" action="{{route('subjects.switch_status')}}" id="switch-status-form">--}}
    {{--        @csrf--}}
    {{--    </form>--}}
</x-management-container>
<script type="text/javascript">


    function openImageModal(btn) {
        let src = $(btn).parent().find($(".img-link")).html();
        $("#modal-img").attr("src", src);
    }

    function deleteFunction(btn) {
        let form = $(btn).parent();
        $("#confirm-delete").click(function () {
            form.submit();
        })
    }

    function updateFunction(btn) {
        $('#update-name').val($(btn).parent().parent().find($('.update-name')).html());
        let subject_id = $(btn).parent().parent().find($('.update-subject-id')).html();
        $('#update-subject-id').val(subject_id);
        $('#update-field-select').val($(btn).parent().find($('.update-field-id')).html()).change();
        let src = $(btn).parent().find($(".img-link")).html();
        $("#update-modal-image").attr("src", src);
    }

    table_init("subjects-table");

    $("#multiple-delete").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.update-subject-id').html();
                $("#multi-delete-form").append('<input type="number" name="' + i + '" value="' + id + '" hidden>');
                i += 1;
            }
        });
        console.log("changing");
        let form = $("#multi-delete-form");
        $("#confirm-delete").click(function () {
            form.submit();
        })
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
