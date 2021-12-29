@component('mail::message')
Dear {{$subscription->customer_name}},
Your subscription to menuthy package has been successful and the payment of {{$subscription->currency}} {{$subscription->amount_paid}} has been recieved.
Thankyou for choosing our services.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
