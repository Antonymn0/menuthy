@component('mail::message')
<img src="{{url('/images/menuthy_logo_i.png')}}" style="width:90px; float:right" alt="menuthy Logo"> <br>
# {{$user->first_name}},
Hope you are enjoying your trial period fully. 
Please click the button below to purchase a package and enjoy our unlimited service.
We have packages that will suite your preference.


@component('mail::button', ['url' => url('/subscription')])
Purchase
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
