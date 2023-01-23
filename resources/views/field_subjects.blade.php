<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">موضوع های یک رشته</x-slot>
    <section class="page-header page-header-classic">
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
                                       id="search-subjects">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text btn-primary" id="button-addon-date"
                                    ><span
                                            class="fe fe-search fe-16"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col p-static mt-1 mb-n1">
                    <h1 data-title-border><small>رشته : </small> {{$field->name}}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="section border-0 m-0 py-3 py-lg-5">

        <div class="container py-md-4">

            <div class="row">
                <div class="col">
                    <div class="row portfolio-list sort-destination" data-sort-id="portfolio"
                         id="subject-container">

                        @foreach(\App\Models\Subject::where("field_id",$field->id)->get() as $s)
                            <div class="col-sm-6 col-lg-3 isotope-item">
                                <div class="portfolio-item">
                                    <a href="{{route("defenses.subject_index",$s)}}">
												<span
                                                    class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom">
												<span class="thumb-info-wrapper">
													<img src="{{getSubjectImagePath($s)}}" class="img-fluid" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner subject-title">{{$s->name}}</span>
														<span class="thumb-info-show-more-content opacity-7"><p
                                                                class="mb-1 mt-1 text-1 line-height-9">{{$s->field->department->name}}بخش </p></span>
													</span>
												</span>
											</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </div>
    </section>


</x-container>
<script type="text/javascript">
    $(document).ready(function () {
        let cw = $('.img-fluid').width();
        $('.img-fluid').css({'height': cw + 'px'});

        $("#search-subjects").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#subject-container div.isotope-item").filter(function () {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                )
            });
            // let container = $('#subject-container');
            //
            // container.isotope({
            //     itemSelector: 'div.isotope-item',
            //     getSortData: {
            //         title: function (el) {
            //             // el refers to each item matching `itemSelector`
            //             return el.find('.subject-title').text().trim();
            //         }
            //     },
            //     sortBy: 'title',
            //     sortAscending: true
            // });
        });

        $(window).on('resize', function () {
            let cw = $('.img-fluid').width();
            $('.img-fluid').css({'height': cw + 'px'});
        });
    });
</script>
