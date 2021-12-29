@component('mail::message')
Dear {{$subscription->customer_name}}, <br>
Your subscription to menuthy package has been successful and a payment of {{$subscription->currency}} {{$subscription->amount_paid}} has been recieved . <br>
Thankyou for choosing our services.



Kind Regards,<br>
{{ config('app.name') }}
@endcomponent
