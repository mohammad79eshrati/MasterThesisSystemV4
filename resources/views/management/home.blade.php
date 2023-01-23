<x-management-container xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot name="title">خانه</x-slot>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\Student::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">دانشجو</h5>
                        </div>
                        <div class="col-auto">
                            <span class="circle circle-lg bg-danger-light">
                            <i class="fe fe-32 fe-users text-white mb-0"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\Professor::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">استاد</h5>
                        </div>
                        <div class="col-auto">
                            <span class="circle circle-lg bg-success-light">
                            <i class="fe fe-32 fe-users text-white mb-0"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\User::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">کل کاربران</h5>
                        </div>
                        <div class="col-auto">
                                                <span class="circle circle-lg bg-primary-light">
                            <i class="fe fe-32 fe-users text-white mb-0"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\Department::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">بخش</h5>
                        </div>
                        <div class="col-auto">
                            <span class="circle circle-lg bg-info-dark">
                            <i class="fa fa-building fa-2x fa-fw text-white mb-0" style="margin: 0 auto;"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\Field::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">رشته</h5>
                        </div>
                        <div class="col-auto">
                            <span class="circle circle-lg bg-primary-dark">
                            <i class="fa fa-graduation-cap fa-2x fa-fw text-white mb-0" style="margin: 0 auto;"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="h2 mb-0">{{\App\Models\Defense::count()}}</span>
                            <h5 class="text-muted font-weight-bold mb-0">دفاع</h5>
                        </div>
                        <div class="col-auto">
                                                <span class="circle circle-lg bg-success-dark">
                            <i class="fa fa-shield fa-2x fa-fw text-white mb-0" style="margin: 0 auto;"></i>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title float-left"><span class="mx-2 text-info"
                                                                style="text-decoration: underline!important;">{{getOnlineStudents()->count()}}</span>
                        دانشجو
                        آنلاین
                    </strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush my-n3">
                        @foreach(getOnlineStudents() as $s)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{getUserProfileURL($s->user)}}" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0"><strong>{{$s->user->name()}}</strong></p>
                                        <small><span class="dot dot-md bg-success ml-1"></span><span
                                                class="text-muted"> آنلاین</span></small>
                                    </div>
                                    <div class="col-auto pr-0">
                                        <small class="fe fe-more-vertical fe-16 text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .list-group -->
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div> <!-- / .col- -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title float-left"><span class="mx-2 text-info"
                                                                style="text-decoration: underline!important;">{{getOnlineProfessors()->count()}}</span>
                        استاد
                        آنلاین
                    </strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush my-n3">
                        @foreach(getOnlineProfessors() as $p)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{getUserProfileURL($p->user)}}" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0"><strong>{{$p->user->name()}}</strong></p>
                                        <small><span class="dot dot-md bg-success ml-1"></span><span
                                                class="text-muted"> آنلاین</span></small>
                                    </div>
                                    <div class="col-auto pr-0">
                                        <small class="fe fe-more-vertical fe-16 text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .list-group -->
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title float-left"><span class="mx-2 text-info"
                                                                style="text-decoration: underline!important;">{{getOnlineAdmins()->count()}}</span>
                        ادمین
                        آنلاین
                    </strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush my-n3">
                        @foreach(getOnlineAdmins()->slice(0,5) as $a)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto avatar avatar-md">
                                        <img src="{{getUserProfileURL($a->user)}}" alt="..."
                                             class="avatar-img rounded-circle square-element">
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0"><strong>{{$a->user->name()}}</strong></p>
                                        <small><span class="dot dot-md bg-success ml-1"></span><span
                                                class="text-muted"> آنلاین</span></small>
                                    </div>
                                    <div class="col-auto pr-0">
                                        <small class="fe fe-more-vertical fe-16 text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .list-group -->
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title float-left">دفاع های اخیر</strong>
                    <a class="float-right small text-muted" href="{{route('defenses')}}">نمایش همه</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush my-n3">
                        @foreach(\App\Models\Defense::orderByDesc('created_at')->limit(5)->get() as $d)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{route('defenses.subject_index',$d->subject)}}">
                                            <div class="avatar avatar-md mt-2">
                                                <img src="{{getSubjectImagePath($d->subject)}}" alt="..."
                                                     class="avatar-img rounded-circle square-element">
                                            </div>
                                        </a>
                                    </div>
                                    <a href="{{route('defenses.show',$d)}}">
                                        <div class="col">
                                            <small><strong>{{$d->student->user->name()}}</strong></small>
                                            <div class="my-0 text-muted small">{{$d->title}}</div>
                                            <small
                                                class="badge badge-light text-muted persian-datetime">{{jalali_to_gregorian($d->date,"Y-m-d")." ".$d->time}}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .list-group -->
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div> <!-- / .col-md-3 -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title float-left">کاربرهایی که اخیرا عضو شده اند</strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush my-n3">
                        @foreach(\App\Models\User::orderByDesc('created_at')->limit(5)->get() as $u)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-md mt-2">
                                            <img src="{{getUserProfileURL($u)}}" alt="..."
                                                 class="avatar-img rounded-circle square-element">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <small><strong>{{$u->name()}}</strong></small>
                                        <div class="my-0 text-muted small">{{$u->email}}</div>
                                        <small
                                            class="badge badge-light text-muted">
                                            {{getPersianRole($u)}}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .list-group -->
                </div> <!-- / .card-body -->
            </div> <!-- / .card -->
        </div> <!-- / .col-md-3 -->
    </div>
</x-management-container>
