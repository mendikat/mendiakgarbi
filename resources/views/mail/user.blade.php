<div>Querido Usuario de <strong>Mendiak Garbi</strong>:</div>
<br />
<div>Te damos las gracias sinceramente por colaborar en el mantenimiento de nuestras montañas. Has suministrado la siguiente información para la incidencia registrada:</div>
<br />
<table style="border: 2px dashed blue; font-size:16px;">
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
<div>La incidencia ha sido registrada correctamente y aparece situada en el mapa en la página de inicio de {{$app_name}} {{$app_website}}</div>
<div>A continuación la afección va a ser revisada para proceder a su subsanación.</div>
<br />
<div>!Gracias a tí las montañas de Araba son mejores!</div>
<div><em>Este mensaje ha sido generado por <strong>Mendiak Garbi</strong>. No lo responda.</em></div>
<br />
<div><img src="{{$app_website}}/resources/img/logo.png" alt="" /></div>