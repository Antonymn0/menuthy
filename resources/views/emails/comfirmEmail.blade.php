@component('mail::message')
# Hello {{$user->first_name}},
We are excited that you are here to try our services.

Please confirm your email address here and get your 15 days trial  instantly.
Just click the button bellow to confirm your email.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/verify-email/ahmnk.uura@gmail.com'])
Verify email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
