@component('mail::message')

# {{$user->first_name}}, Welcome to Menuthy


Thankyou for registering with us.
We help our clients run digital services in their restaurants.
We offer complete end to end solutions from displaying qr code menus to ordering all the way to accepting payments.
Click the link below to watch orientation videos.

@component('mail::button', ['url' => 'http://menuthy.herokuapp.com/'])
See videos
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
