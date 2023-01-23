<x-container xmlns:x="http://www.w3.org/1999/xlink">
    <x:slot name="title">علاقه مندی ها</x:slot>
    <section class="page-header page-header-classic">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home')}}">خانه</a></li>
                        <li class="active">لیست علاقه مندی ها</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col p-static mt-1 mb-n1">
                    <h1 data-title-border>لیست علاقه مندی ها</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-2" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-lg-2">

                <aside class="sidebar mt-3 mt-lg-0">
                    <h5 class="font-weight-bold"><strong>فیلتر</strong> بر اساس </h5>
                    <ul class="nav nav-list flex-column  sort-source sort-source-style-3 justify-content-center"
                        data-sort-id="portfolio" data-option-key="filter"
                        data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
                        <li class="nav-item active" data-option-value="*"><a
                                class="nav-link text-1 text-uppercase active"
                                href="#">نمایش همه</a></li>

                        @foreach(\App\Models\Department::all() as $d)
                            @if(\App\Models\Field::where("department_id",$d->id)->first() !== null)
                                <li class="nav-item">
                                    <a class="nav-link text-1 text-uppercase" data-toggle="collapse"
                                       href="#collapse-{{$d->id}}" data-target="#collapse-{{$d->id}}">
                                        {{$d->name}}
                                    </a>
                                </li>
                                <div id="collapse-{{$d->id}}" class="collapse out" style="padding-right: 16px">
                                    @foreach(\App\Models\Field::where("department_id",$d->id)->get() as $f)
                                        <li class="nav-item" data-option-value=".field-{{$f->id}}"
                                        ><a
                                                class="nav-link text-1 text-uppercase" href="#">{{$f->name}}</a></li>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                    </ul>
                </aside>
            </div>
            <div class="col-lg-10">
                <div class="sort-destination-loader sort-destination-loader-showing mt-4 pt-2">
                    <div class="row portfolio-list sort-destination" data-sort-id="portfolio" id="subject-container">
                        @foreach(\App\Models\Subject::all() as $s)
                            <div class="isotope-item ml-1 field-{{$s->field->id}}">
                                @if(Auth::user()->interests->contains($s->id))
                                    <span
                                        class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-centered-info thumb-info-no-zoom thumb-info-centered-icons thumb-info-slide-info-hover">
																						<button type="button"
                                                                                                onclick="addSubject(this)"
                                                                                                class="btn btn-rounded btn-success  btn-with-arrow mb-2"
                                                                                                id="{{$s->id}}"
                                                                                                href="#">{{$s->name}}<span><i
                                                                                                    class="fa-solid fa-check"></i></span></button>

											</span>
                                @else
                                    <span
                                        class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-centered-info thumb-info-no-zoom thumb-info-centered-icons thumb-info-slide-info-hover">
																						<button type="button"
                                                                                                onclick="addSubject(this)"
                                                                                                class="btn btn-outline btn-rounded btn-quaternary  btn-with-arrow mb-2"
                                                                                                id="{{$s->id}}"
                                                                                                href="#">{{$s->name}}<span><i
                                                                                                    class="fa-solid fa-plus"></i></span></button>

											</span>

                                @endif
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-container>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('button').on('click mousedown mouseup', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
    });

    function addSubject(e) {
        if ($(e).hasClass("btn-success")) {
            $(e).removeClass("btn-success");
            $(e).find($("i")).removeClass("fa-check");
            // $(e).find($("span")).removeClass("ml-2");
            $(e).addClass("btn-quaternary");
            // $(e).addClass("btn-with-arrow");
            $(e).addClass("btn-outline");
            $(e).find($("i")).addClass("fa-plus");
            $.get("{{route("interests.remove","")}}" + "/" + $(e).attr("id")); //
        } else {
            $(e).removeClass("btn-quaternary");
            // $(e).removeClass("btn-with-arrow");
            $(e).removeClass("btn-outline");
            $(e).find($("i")).removeClass("fa-plus");
            $(e).addClass("btn-success");
            $(e).find($("i")).addClass("fa-check");
            // $(e).find($("span")).addClass("ml-2");
            $.get("{{route("interests.add","")}}" + "/" + $(e).attr("id")); //
        }
    }
</script>
