@component('mail::message')
# Payments
Dear {{$user->first_name}},
 


Please visit our payments section to purchase your package and enjoy uniterupted service.
We have exciting and pocket friendly offers for everyone.

@component('mail::button', ['url' => url('/dashboard')])
Payments
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
