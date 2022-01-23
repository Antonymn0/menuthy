@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
Dear {{$subscription->customer_name}}, <br>
Your subscription to menuthy {{$subscription->package_type}} {{$subscription->package_period}} package has been successful and a payment of {{$subscription->currency}} {{$subscription->amount_paid}} has been received . <br>
Thankyou for choosing our services.

Kind Regards,<br>
{{ config('app.name') }}
@endcomponent
