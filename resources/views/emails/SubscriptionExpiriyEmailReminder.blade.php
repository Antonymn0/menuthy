@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
# Dear {{$user->first_name}},

Your subscription will expire in the next few days.
Please make arrangements to extend it and avoid  service interuption.
visit the link below to extend.

@component('mail::button', ['url' => url('/subscription')])
Extend Subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
