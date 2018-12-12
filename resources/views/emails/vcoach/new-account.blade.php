Dear {{ $user['first_name']}}  {{$user['last_name'] }},
<br><br>
Your Portal Account has been created.
<br><br>
You can access the portal with the credentials provided below:
<br><br>
{{ link_to_asset('portal') }}
<br><br>
Login: {{ $user['email'] }}
<br><br>
<br>Enjoy!
<br>Pinnacle Performance Company
<br>vcoach@pinper.com
