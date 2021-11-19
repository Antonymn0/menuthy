@component('mail::message')
# Dear {{$user->first_name}},

Your subscription is expiring in less than a months time.
Please make arrangements to extend it and avoid inconvinences or  service interuption.
visit the link below to make payments

@component('mail::button', ['url' => 'menuthy.com'])
Extend Subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
