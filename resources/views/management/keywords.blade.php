<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">کلمات کلیدی</x-slot>
    <div class="modal fade" id="addNewkeyword" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">کلمه کلیدی جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('keywords.store')}}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="example-keyword">نام کلمه کلیدی</label>
                            <input type="text" id="example-keyword" name="name" class="form-control"
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
    <div class="modal fade" id="updatekeyword" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">ویرایش کلمه کلیدی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('keywords.update')}}">
                        @csrf
                        @method('put')

                        <div class="form-group mb-3">
                            <label for="update-name">نام</label>
                            <input type="text" id="update-name" name="name" class="form-control"
                                   required>
                        </div>
                        <input type="number" name="keyword_id" class="form-control "
                               id="update-keyword-id"
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
                    <h5 class="modal-title" id="verticalModalTitle">آیا مطمئنید که می خواهید این کلمه کلیدی را حذف
                        کنید؟</h5>
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
                    <p class="h3 mb-4">کلمات کلیدی</p>

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
                                        data-target="#addNewkeyword">+ افزودن کلمه کلیدی جدید
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
                    <table class="table table-bordered" id="keywords-table">
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

                        @foreach($keywords as $k)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox-each"
                                               id="{{$k->id}}">
                                        <label class="custom-control-label" for="{{$k->id}}"></label>
                                    </div>
                                </td>
                                <td class="update-keyword-id">{{$k->id}}</td>
                                <td ><a class="update-name" href="{{route('defenses.keyword_index',$k)}}"
                                                           style="color:#ced4da;">{{$k->name}}</a></td>
                                <td>
                                    <button type="button" class="btn mb-2 btn-light update-keyword-btn"
                                            data-toggle="modal"
                                            data-target="#updatekeyword"
                                            onclick="updateFunction(this)"><span
                                            class="fe fe-edit fe-16"></span></button>
                                    <form method="get" action="{{route('keywords.delete',$k->id)}}"
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
    <form method="post" action="{{route('keywords.multi_delete')}}" id="multi-delete-form">
        @csrf
    </form>
    {{--    <form method="post" action="{{route('keywords.switch_status')}}" id="switch-status-form">--}}
    {{--        @csrf--}}
    {{--    </form>--}}
</x-management-container>
<script type="text/javascript">
    function deleteFunction(btn) {
        let form = $(btn).parent();
        $("#confirm-delete").click(function () {
            form.submit();
        })
    }

    function updateFunction(btn) {
        $('#update-name').val($(btn).parent().parent().find($('.update-name')).html());
        let id = $(btn).parent().parent().find($('.update-keyword-id')).html();
        $('#update-keyword-id').val(id);
    }

    table_init("keywords-table");

    $("#multiple-delete").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.update-keyword-id').html();
                $("#multi-delete-form").append('<input type="number" name="' + i + '" value="' + id + '" hidden>');
                i += 1;
            }
        });
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
