{{--@formatter:off--}}
@component('mail::message')

@if($user->role === 'admin')
    #  ادمین گرامی
@elseif($user->role === "professor")
    #  استاد گرامی
@else
    #  دانشجوی گرامی
@endif

اطلاعیه دفاع جدیدی براساس علاقه مندی های شما یافت شده است حهت اطلاعات بیشتر روی گزینه مشاهده دفاع کلیک کنید.
<br>
عنوان دفاع:
@component('mail::panel')
    {!!  $defense->title!!}
@endcomponent
@component('mail::button', ['url' => route('defenses.show',$defense->id)])
    مشاهده دفاع
@endcomponent

باتشکر,<br>
سیستم اطلاع رسانی دفاع پایان نامه دانشگاه شیراز
@endcomponent
