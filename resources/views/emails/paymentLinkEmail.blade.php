@component('mail::message')
<img src="http://menuthy.herokuapp.com/images/menuthy_logo_iii.svg" style="width:90px; float:right" alt="menuthy Logo"> <br>
# Payments
Dear {{$user->first_name}},

Please visit our payments section to purchase your package and enjoy uniterupted service.
We have exciting and pocket friendly offers for everyone.

@component('mail::button', ['url' => url('/subscription')])
Payments
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
