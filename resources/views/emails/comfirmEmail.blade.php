@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
# Verify your email <br>
 Hello {{$user->first_name}}, 

We are excited that you are here to try our services.

Please confirm your email address  and get your 15 days trial  instantly.
Just click the button bellow to verify.

@component('mail::button', ['url' => url('/verify-email/' .$user->email)] )
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
