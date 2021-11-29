@component('mail::message')
# {{$user->first_name}},
Hope you are enjoying your trial period fully. 
Please click the button below to purchase a package and enjoy our unlimited service.



@component('mail::button', ['url' => 'menuthy.com'])
Purchase
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
