<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">دفاع ها</x-slot>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">آیا مطمئنید که می خواهید این دفاع را حذف کنید؟</h5>
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
                    <p class="h3 mb-4">دفاع ها</p>

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
                                <a href="{{route('defenses.create')}}">
                                    <button class="btn btn-primary float-right ml-3" type="button" data-toggle="modal"
                                            data-target="#addNewDefense">+ افزودن دفاع جدید
                                    </button>
                                </a>
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
                    <table class="table table-bordered" id="defenses-table">
                        <thead>

                        <tr role="row">
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-all">
                                    <label class="custom-control-label" for="checkbox-all"></label>
                                </div>
                            </th>
                            <th class="searchable">شناسه</th>
                            <th class="searchable">عنوان</th>
                            <th class="searchable">دانشجو</th>
                            <th class="searchable">استاد راهنما</th>
                            <th class="searchable">تاریخ</th>
                            <th style="width: fit-content">عملیات</th>


                        </tr>

                        </thead>
                        <tbody>

                        @foreach(\App\Models\Defense::all() as $d)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox-each"
                                               id="{{$d->id}}">
                                        <label class="custom-control-label" for="{{$d->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$d->id}}</td>
                                <td><a href="{{route('defenses.show',$d->id)}}" style="color:#ced4da;">{{$d->title}}</a>
                                </td>
                                <td><a href="{{route('defenses.show',$d->id)}}"
                                       style="color:#ced4da;">{{$d->student->user->name()}}</a></td>
                                <td><a href="{{route('defenses.professor_index',$d->professor)}}"
                                       style="color:#ced4da;">{{$d->professor->user->name()}}</a></td>
                                <td class="persian-datetime">{{jalali_to_gregorian($d->date,"Y-m-d")." ".$d->time}}</td>

                                <td>

                                    <span hidden class="defense-id">{{$d->id}}</span>
                                    <a href="{{route("defenses.update",$d->id)}}">
                                        <button type="button"
                                                class="btn mb-2 btn-light update-defense-btn align-center">
                                            <span class="fe fe-edit fe-16"></span>
                                        </button>
                                    </a>
                                    <form method="get" action="{{route('defenses.delete',$d->id)}}"
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
    <form method="post" action="{{route('defenses.multi_delete')}}" id="multi-delete-form">
        @csrf
    </form>
    {{--    <form method="post" action="{{route('defenses.switch_status')}}" id="switch-status-form">--}}
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
        $('#update-email').val($(btn).parent().parent().find($('.update-email')).html());
        $('#update-first-name').val($(btn).parent().find($('.update-first-name')).html());
        $('#update-last-name').val($(btn).parent().find($('.update-last-name')).html());
        $('#update-birth-date').val($(btn).parent().find($('.update-birth-date')).html());
        let userId = $(btn).parent().find($('.defense-id')).html();
        $('#defense-id').val(userId);
    }

    table_init("defenses-table");

    $("#multiple-delete").click(function () {
        let i = 1;
        $('.checkbox-each').each(function () {
            if ($(this).is(":checked")) {
                let tr = $(this).parent().parent().parent();
                var id = tr.find('.defense-id').html();
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
                var id = tr.find('.defense-id').html();
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
