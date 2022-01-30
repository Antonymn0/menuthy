@component('mail::message')
# Menuthy-Trial Ending Today <br>

Dear {{$user->full_name}} 


Hope you have enjoyed your trial (Lite) experience. <br>
Your trial (Lite) period is ending today and the  following features will be disabled:

1. Table-scans <br>
2. Dine-In Orders  <br>
3. Kitchen Order Management <br>
4. Cloud POS <br>


If you would wish to continue or start using Advanced features please click the  button below to purchase a plan. <br>
Once again thanks for joining the innovative club.
@component('mail::button', ['url' => url('/subscription')])
Purchace plan
@endcomponent



Regards,<br>
{{env('APP_NAME')}}.
@endcomponent
