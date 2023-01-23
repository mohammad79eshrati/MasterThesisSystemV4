<x-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">جزئیات دفاع</x-slot>
    <div class="modal fade" id="deleteDefenseModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="formModalLabel">آیا مطمئنید که می خواهید این دفاع را حذف کنید؟</p>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>
                    <button type="button" class="btn btn-danger" id="submit_delete_btn">حذف</button>
                </div>
            </div>
        </div>
    </div>

    <section
        class="section section-text-light  section-background section-center section-overlay-opacity section-overlay-opacity-scale-9 sticky-top"
        style="background-image: none;">
        {{--      TODO add background image to this section   --}}
        <div class="container">
            <div class="row">
                <div class="col">
                    @can('update',$defense)
                        <a href="{{route('defenses.edit',$defense->id)}}">
                            <button type="button"
                                    class="mb-1 mt-1 mr-1 btn btn-primary"
                                    style="padding: 10px !important;margin-bottom: 20px!important;float:right;"
                            ><i
                                    class="fa-solid fa-pencil fa-lg" style="margin-left: 8px  !important;"></i> ویرایش
                            </button>
                        </a>
                    @endcan
                    <h3 class="mb-1 font-weight-semi-medium" style="display: inline;">{{$defense->title}}</h3>
                    @can('delete',$defense)
                        <form method="get" style="display: none" action="{{ route('defenses.delete',$defense->id)}}"
                              id="delete_form"></form>
                        <button type="button"
                                class="mb-1 mt-1 mr-1 btn btn-danger"
                                style="padding: 10px !important;margin-bottom: 20px!important;float:left;"
                                data-toggle="modal" data-target="#deleteDefenseModal"
                        ><i
                                class="fa-solid fa-trash fa-lg" style="margin-left: 8px!important;"></i>حذف
                        </button>
                    @endcan
                </div>

            </div>
        </div>
    </section>

    <div class="container pt-2 pb-4">
        {{--                TODO fix tooltips --}}

        <div class="row pb-4 mb-2 mt-3">

            <div class="col-md-6 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeInLeftShorter"
                 data-appear-animation-delay="300" style="max-width: 40% !important;" align="center">

                <span class="thumb-info thumb-info-hide-wrapper-bg">
                    <span class="thumb-info-wrapper">
                        <img src="{{asset("storage/images/".$defense->subject->image_name)}}" class="img-fluid" alt="">
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner"><a style="color: inherit!important;"
                                                              href="{{route('defenses.subject_index',$defense->subject->id)}}">{{$defense->subject->name}}</a></span>
                            <span class="thumb-info-type"><a style="color: inherit!important;"
                                                             href="{{route('defenses.fields_index')}}#field-{{$defense->subject->field->id}}">{{$defense->subject->field->name}}</a></span>
                        </span>
                    </span>
                    <span class="thumb-info-caption">
{{--                                            <span--}}
                        {{--                                                class="thumb-info-caption-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</span>--}}
                        {{--                                            <span class="thumb-info-social-icons">--}}
                        {{--                                                <a target="_blank" href="http://www.facebook.com"><button type="button"--}}
                        {{--                                                                                                          class="mb-1 mt-1 mr-1 btn btn-primary"><i--}}
                        {{--                                                            class="fa-solid fa-pen-to-square"></i> ویرایش</button></a>--}}
                        {{--                                                <a href="http://www.twitter.com"><i--}}
                        {{--                                                        class="fab fa-twitter"></i><span>توییتر</span></a>--}}
                        {{--                                                <a href="http://www.linkedin.com"><i--}}
                        {{--                                                        class="fab fa-linkedin-in"></i><span>لینکدین</span></a>--}}
                        {{--                                            </span>--}}

                    </span>

                </span>


            </div>

            <div class="col-md-6 mt-3 mt-md-0">
                <div class="overflow-hidden">
                    <h2 class="text-color-dark font-weight-normal text-4 mb-2 mt-3 appear-animation"
                        data-appear-animation="maskUp" data-appear-animation-delay="1000"><strong
                            class="font-weight-extra-bold">جزئیات</strong> دفاع</h2>
                </div>

                <ul class="list list-icons list-primary list-borders text-2 appear-animation"
                    data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1200">
                    <li><i class="fas fa-caret-left left-10"></i> <strong class="text-color-primary">دانشجو: </strong>
                        {{$defense->student->user->name()}}
                    </li>
                    <li><i class="fas fa-caret-left left-10"></i> <strong class="text-color-primary">استاد
                            راهنما: </strong>
                        <a href="{{route('defenses.professor_index',$defense->professor)}}"
                           style="color: inherit !important;"> {{$defense->professor->user->name()}}</a>
                    </li>
                    <li><i class="fas fa-caret-left left-10 "></i> <strong class="text-color-primary">تاریخ:</strong>
                        <span
                            class="persian-datetime">{{jalali_to_gregorian($defense->date,"Y-m-d")." ".$defense->time}}</span>
                    </li>
                    @if(count($defense->keywords) > 0)
                        <li><i class="fas fa-caret-left left-10"></i> <strong class="text-color-primary">کلمات
                                کلیدی:</strong>
                            @foreach($defense->keywords as $k)
                                <a href="{{route('defenses.keyword_index',$k->id)}}"
                                   class="badge badge-dark badge-sm badge-pill px-2 py-1 ml-1">{{$k->name}}</a>
                            @endforeach
                        </li>
                    @endif
                    <li><i class="fas fa-caret-left left-10"></i> <strong class="text-color-primary">محل
                            برگزاری: </strong>
                        @if($defense->is_online)
                            <a href="{{$defense->place}}" target="_blank" class="text-dark">{{$defense->place}}</a>
                        @else
                            {{$defense->place}}
                        @endif
                    </li>
                </ul>


                {{--                <div class="row">--}}
                {{--                    <div class="col-12 col-sm-6 col-lg-5 isotope-item leadership">--}}
                {{--								<span class="thumb-info thumb-info-hide-wrapper-bg mb-4">--}}
                {{--									<span class="thumb-info-wrapper">--}}
                {{--										<a href="about-me.html">--}}
                {{--											<img src="{{getUserProfileURL($defense->professor->user)}}"--}}
                {{--                                                 class="img-fluid"--}}
                {{--                                                 alt="">--}}
                {{--											<span class="thumb-info-title">--}}
                {{--												<span--}}
                {{--                                                    class="thumb-info-inner"--}}
                {{--                                                    style="font-size: 14px!important;">{{$defense->professor->user->first_name." ".$defense->professor->user->last_name}}</span>--}}
                {{--												<span class="thumb-info-type">استاد راهنما</span>--}}
                {{--											</span>--}}
                {{--										</a>--}}
                {{--									</span>--}}
                {{--								</span>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-12 col-sm-6 col-lg-5 isotope-item leadership">--}}
                {{--								<span class="thumb-info thumb-info-hide-wrapper-bg mb-4">--}}
                {{--									<span class="thumb-info-wrapper">--}}
                {{--										<a href="about-me.html">--}}
                {{--											<img src="{{getUserProfileURL($defense->student->user)}}"--}}
                {{--                                                 class="img-fluid"--}}
                {{--                                                 alt="">--}}
                {{--											<span class="thumb-info-title">--}}
                {{--												<span--}}
                {{--                                                    class="thumb-info-inner"--}}
                {{--                                                    style="font-size: 14px!important;">{{$defense->student->user->first_name." ".$defense->student->user->last_name}}</span>--}}
                {{--												<span class="thumb-info-type">دانشجو</span>--}}
                {{--											</span>--}}
                {{--										</a>--}}
                {{--									</span>--}}
                {{--								</span>--}}
                {{--                    </div>--}}

                {{--                </div>--}}

            </div>

        </div>
        <div class="overflow-hidden">
            <h2 class="text-color-dark font-weight-normal text-4 mb-2 pb-1"
            ><strong
                    class="font-weight-extra-bold">خلاصه </strong>دفاع</h2>
        </div>
        <div>{!!  $defense->abstract !!}</div>
    </div>
</x-container>
<script type="text/javascript">
    $("#submit_delete_btn").click(function () {
        $("#delete_form").submit();
    });

</script>
