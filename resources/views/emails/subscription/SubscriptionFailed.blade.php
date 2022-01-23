@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
Dear {{$payment->customer_name}}, <br>
Your subscription to menuthy package has not been successful.

Please make sure your stripe account has enough money then try making the payment again. <br>
If the problem persists, contact our support team on this email: support@menuthy.com

Thankyou, <br>
{{ config('app.name') }}
@endcomponent
