<div>Querido Administrador de <strong>Mendiak Garbi</strong>:</div>
<br />
<div>Una nueva incidencia ha sido creada desde la web.</div>
<br />
<table style="border: 2px dashed blue;">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Incidencia</th>
            <th>Tipo</th>
            <th>Latitud</th>
            <th>Longitud</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$user->get_name()}}</td>
            <td>{{$user->get_email()}}</td>
            <td>{{$event->get_name()}}</td>
            <td>{{$type}}</td>
            <td>{{$event->get_lat()}}</td>
            <td>{{$event->get_lng()}}</td>
        </tr>
    </tbody>
</table>
<br />
<h3>Descripción</h3>
<div>{{$event->get_description()}}</div>
<br />
<img src="https://maps.googleapis.com/maps/api/staticmap?center={{$event->get_lat()}},{{$event->get_lng()}}&zoom=15&size=800x800" alt="" />
<br />
<br />
<div><em>Este mensaje ha sido generado de forma automática por <strong>Mendiak Garbi</strong>. No lo reponda.</em></div>