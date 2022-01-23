@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
# Dear {{$user->first_name}} {{$user->last_name}}

Your stripe payment information details have been successfully updated on our system.
If you do not recognize this activity, please check your account or contact us for help.

Regards,<br>
{{ config('app.name') }}
@endcomponent
