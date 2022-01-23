@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
# Dear {{$user->first_name}},

Your subscription is expiring in less than a months time.
Please make arrangements to extend it and avoid  service interuption.
visit the link below to make payments.

@component('mail::button', ['url' => url('/subscription')])
Extend Subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
