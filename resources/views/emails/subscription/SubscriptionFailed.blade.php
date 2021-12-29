@component('mail::message')
Dear {{$subscription->customer_name}},
Your subscription to menuthy package has not been successful.

Please make sure your stripe account has enough money then try making the payment again.
If the problem persists, contact our support team on this email: suppor@menuthy.com



Thanks,<br>
{{ config('app.name') }}
@endcomponent
