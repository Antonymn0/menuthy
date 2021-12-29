@component('mail::message')
<img src="http://menuthy.herokuapp.com/images/menuthy_logo_iii.svg" style="width:90px; float:right" alt="menuthy Logo"> <br>
# {{$user->first_name}},
Hope you are enjoying your trial period fully. 
Please click the button below to purchase a package and enjoy our unlimited service.


@component('mail::button', ['url' => url('/subscription')])
Purchase
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
