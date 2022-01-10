@component('mail::message')
<img src="http://menuthy.herokuapp.com/images/menuthy_logo_iii.svg" style="width:90px; float:right" alt="menuthy Logo"> <br>
# New User Registered Notification <br>
System notification <br>

User {{$user->first_name}} {{$user->last_name}} of email {{$user->email}} has newly registered on this system.

This is a system generated notification email. Do not reply.

Thankyou,<br>

@endcomponent
