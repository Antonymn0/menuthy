@component('mail::message')
# Verify email
# Hello {{$user->first_name}},   <img src="/public/images/menuthy_logo_iii.png" style="width:30%" alt="App Logo" class="float-right">


We are excited that you are here to try our services.

Please confirm your email address here and get your 15 days trial  instantly.
Just click the button bellow to confirm your email.

@component('mail::button', ['url' => url('/verify-email/' .$user->email)] )
Verify email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
