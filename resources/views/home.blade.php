<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">خانه</x-slot>

    <section class="section m-0 border-0 pt-0" style="height: 100% !important;">

        <div class="row my-3">
            <div class="col">
                <section class="section section-quaternary sticky-top mt-0 py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-1">موضوعات اخیر</h4>
                                <p class="mb-0">موضوعاتی که اخیرا اضاف شده و شاید شما به آن ها علاقه داشته باشید</p>

                            </div>
                        </div>
                    </div>
                </section>
                <div class="owl-carousel owl-theme full-width subject-list"
                     data-plugin-options="{'items': 5, 'loop': false, 'nav': true, 'dots': false}">
                    @foreach($recentSubjects as $s)
                        <div class="m-2">
                            <a href="{{route('defenses.subject_index',$s)}}">

                                <span
                                    class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom"
                                >
								<span class="thumb-info-wrapper">
									<img src="{{getSubjectImagePath($s)}}"
                                         class="img-fluid"
                                         alt="">
									<span class="thumb-info-title opacity-9">
										<span class="thumb-info-inner">{{$s->name}}</span>
										<span class="thumb-info-type  opacity-8">رشته {{$s->field->name}}</span>
                                        <span class="thumb-info-show-more-content opacity-7"><p
                                                class="mb-1 mt-1 text-1 line-height-9">بخش {{$s->field->department->name}}</p></span>

									</span>
								</span>
							</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col py-4">
                <hr class="solid">
            </div>
        </div>

        <div class="row pb-4">
            <div class="col">
                <section class="section section-tertiary sticky-top py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-1">دفاع های اخیر</h4>
                                <p class="mb-0">دفاع هایی که اخیرا ثبت شده اند که ممکن است مورد پسند شما باشد</p>

                            </div>
                        </div>
                    </div>
                </section>
                <div class="owl-carousel owl-theme show-nav-title top-border mb-0 mt-5"
                     data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'items': 3, 'margin': 30, 'loop': false, 'nav': true, 'dots': false}">
                    @foreach($recentDefenses as $d)
                        <div>
                            <div class="recent-posts">
                                <article class="post">
                                    <div class="post-date">
                                        <span class="day">{{date('d',strtotime($d->date))}}</span>
                                        <span class="month">{{getJalaliMonth($d->date)}}</span>
                                    </div>
                                    <h4><a href="{{route('defenses.show',$d)}}"
                                           class="text-decoration-none">{{$d->title}}</a></h4>
                                    <p>{!! substr(strip_tags($d->abstract),0,80*8) !!}...
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i>دانشجو  <a
                                                href="#">{{$d->student->user->name()}}</a> </span>
                                        <span><i class="far fa-user"></i>استاد راهنما  <a
                                                href="{{route('defenses.professor_index',$d->professor)}}">{{$d->professor->user->name()}}</a> </span>
                                        <span><i class="far fa-folder"></i> <a
                                                href="{{route('defenses.subject_index',$d->subject)}}">{{$d->subject->name}}</a></span>
                                        <hr class="solid">
                                        <a href="{{route('defenses.show',$d)}}"
                                           class="btn btn-xs btn-primary float-right mb-4">بیشتر
                                            بخوانید ...</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col py-4">
                <hr class="solid">
            </div>
        </div>

        <div class="row">
            <div class="col">

                <section class="section section-secondary p-4 sticky-top">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-1">دفاع های مورد علاقه</h4>
                                <p class="mb-0">دفاع هایی که ممکن است بخواهید در آن شرکت کنید</p>
                            </div>
                            <div class="col" align="left" style="max-width: fit-content">
                                <div class="form-row" align="left">
                                    <div class="form-group" style="width: 300px !important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-group"
                                                   placeholder="جستجو ..."
                                                   id="search-defenses">
                                            <div class="input-group-append">
                                                <button type="button" class="input-group-text btn-primary"
                                                        id="button-addon-date"
                                                        data-toggle="modal"
                                                        data-target="#addStudentModal"><span
                                                        class="fe fe-search fe-16"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                </section>
                <div class="blog-posts recent-posts px-2">

                    <div id="portfolioLoadMoreWrapper"
                         class="row masonry portfolio-list sort-destination"
                         data-plugin-masonry
                         data-plugin-options="{'itemSelector': '.masonry-item'}" data-total-pages="3"
                         data-ajax-url="ajax/index-blog-4-ajax-load-more-" data-sort-id="portfolio"
                         id="subject-container">

                        @foreach($favoriteDefenses  as $d)
                            <div
                                class="masonry-item no-default-style col-md-3 field-{{$d->subject->field->id}} field-{{$d->student->field->id}}">
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
                                            <span><i class="far fa-user"></i> استاد راهنما <a
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
    </section>
</x-container>
<script type="text/javascript">

    $(document).ready(function () {
        $('.subject-list').find($(".owl-item")).each(function () {
            let dis = $(this);
            dis.css('height', dis.css('width'));
            dis.find($('img')).css('height', dis.find('img').css('width'));
        });

        $(window).on('resize', function () {
            $('.subject-list').find($(".owl-item")).each(function () {
                let dis = $(this);
                dis.css('height', dis.css('width'));
                dis.find($('img')).css('height', dis.find('img').css('width'));
            });
        });
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
