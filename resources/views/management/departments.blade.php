<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">بخش ها</x-slot>
    <div class="modal fade" id="addNewdepartment" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">بخش جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('departments.store')}}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="example-department">نام بخش</label>
                            <input type="text" id="example-department" name="name" class="form-control"
                                   required>
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
    <div class="modal fade" id="updatedepartment" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">ویرایش بخش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('departments.update')}}">
                        @csrf
                        @method('put')

                        <div class="form-group mb-3">
                            <label for="update-name">نام</label>
                            <input type="text" id="update-name" name="name" class="form-control"
                                   required>
                        </div>
                        <input type="number" name="department_id" class="form-control "
                               id="update-department-id"
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
                    <h5 class="modal-title" id="verticalModalTitle">آیا مطمئنید که می خواهید این بخش را حذف کنید؟</h5>
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
                    <p class="h3 mb-4">بخش ها</p>

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
                                        data-target="#addNewdepartment">+ افزودن بخش جدید
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
                    <table class="table table-bordered" id="departments-table">
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

                            <th>عملیات</th>


                        </tr>

                        </thead>
                        <tbody>

                        @foreach($departments as $d)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox-each"
                                               id="{{$d->id}}">
                                        <label class="custom-control-label" for="{{$d->id}}"></label>
                                    </div>
                                </td>
                                <td class="update-department-id">{{$d->id}}</td>
                                <td ><a class="update-name" href="{{route('defenses.department_index',$d)}}" style="color: inherit!important;"> {{$d->name}}</a></td>
                                <td>
                                    <button type="button" class="btn mb-2 btn-light update-department-btn"
                                            data-toggle="modal"
                                            data-target="#updatedepartment"
                                            onclick="updateFunction(this)"><span
                                            class="fe fe-edit fe-16"
                                        ></span></button>
                                    <form method="get" action="{{route('departments.delete',$d->id)}}"
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
    <form method="post" action="{{route('departments.multi_delete')}}" id="multi-delete-form">
        @csrf
    </form>
    {{--    <form method="post" action="{{route('departments.switch_status')}}" id="switch-status-form">--}}
    {{--        @csrf--}}
    {{--    </form>--}}
</x-management-container>
<script type="text/javascript">


    table_init("departments-table");

    // $('.update-department-btn').click(function () {
    //
    // });

    // $('.open-delete-modal').click(function () {
    //
    // })

    function deleteFunction(btn) {
        let form = $(btn).parent();
        $("#confirm-delete").click(function () {
            form.submit();
        })
    }

    function updateFunction(btn) {
        $('#update-name').val($(btn).parent().parent().find($('.update-name')).html());
        let id = $(btn).parent().parent().find($('.update-department-id')).html();
        $('#update-department-id').val(id);
    }

    $("#multiple-delete").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.update-department-id').html();
                $("#multi-delete-form").append('<input type="number" name="' + i + '" value="' + id + '" hidden>');
                i += 1;
            }
        });
        let form = $("#multi-delete-form");
        $("#confirm-delete").click(function () {
            form.submit();
        })
    });


    $(".open-delete-modal").each(function () {
        $(this).click(function () {
            console.log($(this).parent().attr('action'));
            let form = $(this).parent();
            $("#confirm-delete").click(function () {
                form.submit();
            })
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
