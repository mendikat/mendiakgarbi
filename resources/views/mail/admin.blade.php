<div>Querido Administrador de <strong>Mendiak Garbi</strong>:</div>
<br />
<div>Una nueva incidencia ha sido creada desde la web.</div>
<br />
<table style="border: 2px dashed blue; font-size:16px;">
    <tr>
        <td><strong>Usuario</strong></td>
        <td style="color: blue;">{{$user->get_name()}}</td>
    </tr>   
    <tr>
        <td><strong>Email</strong></td>
        <td style="color: blue;">{{$user->get_email()}}</td>
    </tr>
    <tr>
        <td><strong>Incidencia</strong></td>
        <td style="color: blue;">{{$event->get_name()}}</td>        
    </tr>
    <tr>
        <td><strong>Tipo</strong></td>
        <td style="color: blue;">{{$type->get_nameES()}}</td>
    </tr>
    <tr>
        <td><strong>Latitud</strong></td>
        <td style="color: blue;">{{$event->get_lat()}}</td>
    </tr>
    <tr>
        <td><strong>Longitud</strong></td>
        <td style="color: blue;">{{$event->get_lng()}}</td>
   </tr>
</table>
<br />
<h3>Descripci&oacute;n</h3>
<div>{{$event->get_description()}}</div>
<br />
<img src="https://maps.googleapis.com/maps/api/staticmap?center={{$event->get_lat()}},{{$event->get_lng()}}&zoom=15&size=800x800" alt="" />
<br />
<div>
    <a href="https://www.google.com/maps/?q={{$event->get_lat()}},{{$event->get_lng()}}">Ver la localizaci&oacute;n exacta</a>
</div>
<br />
<div><em>Este mensaje ha sido generado por <strong>Mendiak Garbi</strong>. No lo responda.</em></div>
<br />
<div><img src="{{$app_website}}/resources/img/logo.png" alt="" /></div>