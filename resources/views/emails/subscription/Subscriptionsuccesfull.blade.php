@component('mail::message')
<img src="http://menuthy.herokuapp.com/images/menuthy_logo_iii.svg" style="width:90px; float:right" alt="menuthy Logo"> <br>
Dear {{$subscription->customer_name}}, <br>
Your subscription to menuthy package has been successful and a payment of {{$subscription->currency}} {{$subscription->amount_paid}} has been recieved . <br>
Thankyou for choosing our services.
{{$subscription}}



Kind Regards,<br>
{{ config('app.name') }}
@endcomponent
