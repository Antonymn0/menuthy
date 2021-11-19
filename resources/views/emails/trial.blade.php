@component('mail::message')
# {{$user->first_name}},
Hope you are enjoying your trial period fully. 
Please click the button below to purchase you package and enjoy unlimited service.

The body of your message.

@component('mail::button', ['url' => 'menuthy.com'])
Purchase
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
