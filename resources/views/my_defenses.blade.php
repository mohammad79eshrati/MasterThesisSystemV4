<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot name="title">دفاع های من</x-slot>
    <div class="tabs tabs-bottom tabs-center tabs-simple" style="height: 100% !important;">
        <ul class="nav nav-tabs sticky-top bg-light">
            @can('create',\App\Models\Defense::class)
                <a href="{{route("defenses.create")}}">
                    <button type="button"
                            class="mb-1 mt-1 mr-1 btn btn-info absolute-bottom"
                            style="padding: 10px !important;margin: 20px!important;width:fit-content!important;"
                            data-toggle="modal" data-target="#deleteDefenseModal"
                    ><i
                            class="fa-solid fa-plus fa-lg" style="margin-left: 5px!important;"></i>افزودن دفاع جدید
                    </button>
                </a>
                <li class="nav-item active">
                    <a class="nav-link" href="#createdByMeDefenses" data-toggle="tab">دفاع های ساخته
                        شده توسط من</a>
                </li>
            @endcan
            @if(\Illuminate\Support\Facades\Auth::user()->role !== 'admin')
                <li class="nav-item
            @cannot('create',\App\Models\Defense::class)
                active
                @endcannot
            ">
                    <a class="nav-link" href="#relatedToMeDefenses" data-toggle="tab">دفاع های
                        مربوط به من</a>
                </li>
            @endif
        </ul>
        <div class="tab-content" style="height: 100% !important;">
            @can('create',\App\Models\Defense::class)
                <section class="section border-0 m-0 py-3 py-lg-5 tab-pane active" id="createdByMeDefenses"
                         style="height: fit-content !important;">

                    <div class="container py-md-4">

                        <div class="row">

                            <div class="col">

                                <div class="blog-posts recent-posts">

                                    <div id="portfolioLoadMoreWrapper1" class="row masonry" data-plugin-masonry
                                         data-plugin-options="{'itemSelector': '.masonry-item'}" data-total-pages="3"
                                         data-ajax-url="ajax/index-blog-4-ajax-load-more-"
                                    >
                                        @foreach(\App\Models\Defense::where('creator_id',\Illuminate\Support\Facades\Auth::user()->id)->get() as $d)
                                            <div class="masonry-item no-default-style col-md-3">
                                                <article
                                                    class="post post-medium border-0 pb-0 mb-5">
                                                    <div class="post-image">
                                                        <a href="{{route('defenses.show',$d->id)}}">
                                                            <img
                                                                src="{{getSubjectImagePath($d->subject)}}"
                                                                class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0 w-100"
                                                                alt="How To Take Better Concert Pictures in 30 Seconds">
                                                            <div
                                                                class="date p-absolute z-index-2 top-10 right-10 mr-0 mr-3 pl-1 pt-1">
                                            <span
                                                class="day bg-color-light font-weight-extra-bold py-2 text-color-dark">{{date('d',strtotime($d->date))}}</span>
                                                                <span
                                                                    class="month text-1 bg-color-light line-height-9 text-default w-100 top-2 d-block py-0 mb-1"><span
                                                                        class="text-1">{{getJalaliMonth($d->date)}}</span></span>
                                                                <span
                                                                    class="year text-1 bg-color-light line-height-9 text-default w-100 to d-block py-0"><span
                                                                        class="text-1">{{date('Y',strtotime($d->date))}}</span></span>

                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div
                                                        class="post-content bg-color-grey-scale-2 p-4">

                                                        <h4 class="font-weight-bold text-3 line-height-7 mt-0 mb-3">
                                                            <a
                                                                href="{{route('defenses.show',$d->id)}}">{{$d->title}}</a>
                                                        </h4>
                                                        <div class="post-meta m-0 p-0">
                                                <span><i class="far fa-user"></i> دانشجو <a
                                                        href="#">{{$d->student->user->name()}}</a></span>
                                                            <span class="mb-2"><i
                                                                    class="far fa-user"></i> استاد راهنما <a
                                                                    href="{{route('defenses.professor_index',$d->professor)}}">{{$d->professor->user->name()}}</a> </span>
                                                            <span class="mb-2"><i class="far fa-folder"></i> <a
                                                                    href="{{route('defenses.subject_index',$d->subject)}}">{{$d->subject->name}}</a></span>

                                                            <br/>
                                                            <span>
                                                    @foreach($d->keywords->sortBy(function ($k){return ustrlen($k->name);}) as $k)
                                                                    <a href="{{route('defenses.keyword_index',$k->id)}}"><span
                                                                            class="badge badge-primary badge-sm badge-pill py-1 mr-1 text-uppercase font-weight-regular">{{$k->name}}</span></a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endcan

            @if(\Illuminate\Support\Facades\Auth::user()->role !== 'admin')
                <section class="section border-0 m-0 py-3 py-lg-5 tab-pane
                    @cannot('create',\App\Models\Defense::class)
                       active
                    @endcannot
                    " id="relatedToMeDefenses"
                         style="height: fit-content !important;">

                    <div class="container py-md-4">

                        <div class="row">

                            <div class="col">

                                <div class="blog-posts recent-posts">

                                    <div id="portfolioLoadMoreWrapper2" class="row masonry" data-plugin-masonry
                                         data-plugin-options="{'itemSelector': '.masonry-item'}" data-total-pages="3"
                                         data-ajax-url="ajax/index-blog-4-ajax-load-more-"
                                         >

                                        @foreach(\App\Models\Defense::where('std_num',\Illuminate\Support\Facades\Auth::user()->student?\Illuminate\Support\Facades\Auth::user()->student->std_num:0)->orWhere('prof_id',\Illuminate\Support\Facades\Auth::user()->professor?\Illuminate\Support\Facades\Auth::user()->professor->prof_id:0)->get() as $d)

                                            <div class="masonry-item no-default-style col-md-3">
                                                <article class="post post-medium border-0 pb-0 mb-5">
                                                    <div class="post-image">
                                                        <a href="{{route('defenses.show',$d->id)}}">
                                                            <img
                                                                src="{{asset('storage/images/'.$d->subject->image_name)}}"
                                                                class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0 w-100"
                                                                alt="How To Take Better Concert Pictures in 30 Seconds">
                                                            <div
                                                                class="date p-absolute z-index-2 top-10 right-10 mr-0 mr-3 pl-1 pt-1">
                                            <span
                                                class="day bg-color-light font-weight-extra-bold py-2 text-color-dark">{{date('d',strtotime($d->date))}}</span>
                                                                <span
                                                                    class="month text-1 bg-color-light line-height-9 text-default w-100 top-2 d-block py-0 mb-1"><span
                                                                        class="text-1">{{getJalaliMonth($d->date)}}</span></span>
                                                                <span
                                                                    class="year text-1 bg-color-light line-height-9 text-default w-100 to d-block py-0"><span
                                                                        class="text-1">{{date('Y',strtotime($d->date))}}</span></span>

                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="post-content bg-color-light p-4">

                                                        <h4 class="font-weight-bold text-3 line-height-7 mt-0 mb-3"><a
                                                                href="{{route('defenses.show',$d->id)}}">{{$d->title}}</a>
                                                        </h4>
                                                        <div class="post-meta m-0 p-0">
                                                <span><i class="far fa-user"></i> دانشجو <a
                                                        href="#">{{$d->student->user->name()}}</a></span>
                                                            <span class="mb-2"><i class="far fa-user"></i> استاد راهنما <a
                                                                    href="{{route('defenses.professor_index',$d->professor)}}">{{$d->professor->user->name()}}</a> </span>
                                                            <br/>
                                                            <span>

                                                    @foreach($d->keywords->sortBy(function ($k){return ustrlen($k->name);}) as $k)
                                                                    <a href="{{route('defenses.keyword_index',$k->id)}}"><span
                                                                            class="badge badge-primary badge-sm badge-pill py-1 mr-1 text-uppercase font-weight-regular">{{$k->name}}</span></a>
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
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            @endif

        </div>

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


</x-container>

<script type="text/javascript">
    $(document).ready(function () {
        $("#portfolioLoadMoreWrapper1,#portfolioLoadMoreWrapper2").css('height', "100vh");
    });
</script>
