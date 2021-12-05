@component('mail::message')
# Hello {{$user->first_name}},
We are excited that you are here to try our services.

Please confirm your email address here and get your 15 days trial  instantly.
Just click the button bellow to confirm your email.

@component('mail::button', ['url' => url() . '/verify-email/' . $user->email])
Verify email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
