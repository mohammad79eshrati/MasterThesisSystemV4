<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">دفاع های یک بخش</x-slot>
    <section class="page-header page-header-classic" style="margin: 0 !important;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home')}}">خانه</a></li>
                        <li class="active">دفاع ها</li>
                    </ul>
                </div>
                <div class="col" align="left" style="max-width: fit-content">
                    <div class="form-row" align="left">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-group" placeholder="جستجو ..."
                                       id="search-defenses">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text btn-primary" id="button-addon-date"
                                            data-toggle="modal"
                                            data-target="#addStudentModal"><span
                                            class="fe fe-search fe-16"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col p-static mt-1 mb-n1">
                    <h1 data-title-border><small>بخش : </small> {{$department->name}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-2 px-0" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-lg-2">
                <aside class="sidebar mt-3 pt-3 pl-3 mt-lg-0 sticky-right ">
                    <h5 class="font-weight-bold"><strong>فیلتر</strong> بر اساس </h5>
                    <ul class="nav nav-list flex-column  sort-source sort-source-style-3 justify-content-center"
                        data-sort-id="portfolio" data-option-key="filter"
                        data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
                        <li class="nav-item active" data-option-value="*"><a
                                class="nav-link text-1 text-uppercase active"
                                href="#">نمایش همه ({{\App\Models\Defense::count()}})</a></li>


                        @foreach(\App\Models\Field::where("department_id",$department->id)->get() as $f)
                            <li class="nav-item" data-option-value=".field-{{$f->id}}"
                            ><a data-option-value=".field-{{$f->id}}"
                                class="nav-link text-1 text-uppercase" href="#">{{$f->name}}
                                    ({{getFieldDefenses($f)->count()}})</a></li>
                        @endforeach


                    </ul>
                </aside>
            </div>
            <div class="col-lg-10">
                <section class="section border-0 m-0 p-0">

                    <div class="container py-md-4">

                        <div class="row">
                            <div class="col">
                                <div class="blog-posts recent-posts">

                                    <div id="portfolioLoadMoreWrapper"
                                         class="row masonry portfolio-list sort-destination"
                                         data-plugin-masonry
                                         data-plugin-options="{'itemSelector': '.masonry-item'}" data-total-pages="3"
                                         data-ajax-url="ajax/index-blog-4-ajax-load-more-" data-sort-id="portfolio"
                                         id="subject-container">

                                        @foreach(getDepratmentDefenses($department)  as $d)
                                            <div
                                                class="masonry-item no-default-style col-md-4 field-{{$d->subject->field->id}} field-{{$d->student->field->id}}">
                                                <article class="post post-medium border-0 pb-0 mb-5">
                                                    <div class="post-image">
                                                        <a href="{{route('defenses.show',$d->id)}}">
                                                            <img src="{{getSubjectImagePath($d->subject)}}"
                                                                 class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0 w-100"
                                                                 alt="How To Take Better Concert Pictures in 30 Seconds">
                                                            <div
                                                                class="date p-absolute z-index-2 top-10 right-10 mr-0 mr-3 pl-1 pt-1">
                                            <span
                                                class="day bg-color-light font-weight-extra-bold py-2 text-color-dark defense-day">{{date('d',strtotime($d->date))}}</span>
                                                                <span
                                                                    class="month text-1 bg-color-light line-height-9 text-default w-100 top-2 d-block py-0 mb-1"><span
                                                                        class="text-1 defense-month">{{getJalaliMonth($d->date)}}</span></span>
                                                                <span
                                                                    class="year text-1 bg-color-light line-height-9 text-default w-100 to d-block py-0"><span
                                                                        class="text-1 defense-year">{{date('Y',strtotime($d->date))}}</span></span>

                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="post-content bg-color-grey-scale-2 p-4">

                                                        <h4 class="font-weight-bold text-3 line-height-7 mt-0 mb-3 "><a
                                                                class="defense-title"
                                                                href="{{route('defenses.show',$d->id)}}">{{$d->title}}</a>
                                                        </h4>
                                                        <div class="post-meta m-0 p-0">
                                                <span><i class="far fa-user"></i> دانشجو <a
                                                        href="#"
                                                        class="defense-student">{{$d->student->user->name()}}</a></span>
                                                            <span class="mb-2"><i class="far fa-user"></i> استاد راهنما <a
                                                                    href="{{route('defenses.professor_index',$d->professor)}}"
                                                                    class="defense-professor">{{$d->professor->user->name()}}</a> </span>
                                                            <span class="mb-2"><i class="far fa-folder"></i> <a
                                                                    href="{{route('defenses.subject_index',$d->subject)}}">{{$d->subject->name}}</a></span>

                                                            <br/>
                                                            <span>
                                                    @foreach($d->keywords->sortBy(function ($k){return ustrlen($k->name);}) as $k)
                                                                    <a href="{{route('defenses.keyword_index',$k->id)}}"><span
                                                                            class="badge badge-primary badge-sm badge-pill py-1 mr-1 text-uppercase font-weight-regular defense-keyword">{{$k->name}}</span></a>
                                                                @endforeach
                                                </span>
                                                            <span class="d-block mt-2 pt-1"><a
                                                                    href="{{route('defenses.show',$d->id)}}"
                                                                    class="btn btn-xs btn-light text-1 text-uppercase">بیشتر بخوانید</a></span>
                                                        </div>

                                                    </div>
                                                </article>
                                            </div>
                                        @endforeach


                                    </div>

                                    <div id="portfolioLoadMoreBtnWrapper" class="row">
                                        <div class="col text-center">

                                            <div id="portfolioLoadMoreLoader" class="portfolio-load-more-loader"
                                                 style="min-height: 61px;">
                                                <div class="bounce-loader">
                                                    <div class="bounce1"></div>
                                                    <div class="bounce2"></div>
                                                    <div class="bounce3"></div>
                                                </div>
                                            </div>

                                            <button id="portfolioLoadMore"
                                                    class="btn btn-portfolio-infinite-scroll btn-primary font-weight-bold text-3 px-5 py-3">
                                                بارگذاری بیشتر ...
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</x-container>
<script type="text/javascript">
    $(document).ready(function () {
        $(".nav-item[data-option-value='." + window.location.hash.substring(1) + "']").parent().collapse('show');

        $("#search-defenses").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#portfolioLoadMoreWrapper div.masonry-item").filter(function () {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                )
            });
            var container = $('#portfolioLoadMoreWrapper');

            container.isotope({
                itemSelector: 'div.masonry-item',
                getSortData: {
                    title: function (el) {
                        // el refers to each item matching `itemSelector`
                        return el.find('.defense-title').text().trim();
                    }
                },
                sortBy: 'title',
                sortAscending: true
            });
        });
    });
</script>
