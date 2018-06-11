@extends('layouts/admin') {{-- Load the simple layout --}}
@section('css')
<link rel="stylesheet" href="resources/vendor/datatable/datatables.min.css" />
<link rel="stylesheet" href="resources/vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
@stop
@section('body')
<!-- Modal Delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$app_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4 id="modal-message">¿Desea Eliminar la incidencia?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btn-delete-accept">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Delete -->
<div class="container">

    <table class="table table-striped table-responsive" id="table-events">
        <thead>
            <th>Id</th>
            <th>Alta</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Modificada</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr data-id="{{$event->get_id()}}">
                <td>{{$event->get_id()}}</td>
                <td>{{$event->get_date_c()->format( DATETIME_FORMAT)}}</td>
                <td>{{$event->get_name()}}</td>
                <td>{{$event->get_description()}}</td>
                <td>{{$event->get_type()->get_nameES()}}</td>
                <td><a href="mailto:{{$event->get_user()->get_email()}}">{{$event->get_user()->get_name()}}</a></td>
                <td>
                    {{$event->get_status()->get_nameES()}} <span>{{$event->get_status()->get_progress()}}%</span>
                    <div class="progress">
                        <div class="progress-bar @if( $event->get_status()->get_progress() < 30 ) bg-danger
                                             @elseif( $event->get_status()->get_progress() < 100 ) bg-warning 
                                             @else bg-success
                                             @endif  progress-bar-striped active" style="width: {{$event->get_status()->get_progress()}}%;"></div>
                    </div>
                </td>               
                <td>{{$event->get_date_m()->format( DATETIME_FORMAT)}}</td>
                <td>
                    <span><button class="btn btn-outline-success btn-show" data-id="{{$event->get_id()}}"><i class="fa fa-eye"></i></button>
                    <span><button class="btn btn-outline-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$event->get_id()}}"><i class="fa fa-eraser"></i></button>                    
                    <div>
                        <i class="fa fa-thermometer-half"></i> <strong>Situación</strong>
                        <select class="select" data-id="{{$event->get_id()}}">
                        @foreach($status as $statu)
                            <option value="{{$statu->get_id()}}" data-progress="{{$statu->get_progress()}}" @if( $statu->get_id() == $event->get_status()->get_id() ) selected  @endif> 
                            {{$statu->get_nameES()}}
                        </option>
                        @endforeach
                        </select>    
                    </div>                  
                </td>
            </tr>
            @endforeach
        </tbody>    
    </table>

</div>
@stop
@section('scripts')
<script src="resources/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="resources/vendor/datatable/datatables.min.js"></script>
<script src="resources/vendor/datatable/pdfmake.min.js"></script>
<script src="resources/vendor/datatable/buttons.html5.min.js"></script>
<script src="resources/vendor/datatable/dataTables.buttons.min.js"></script>
<script src="resources/vendor/datatable/jszip.min.js"></script>
<script src="resources/vendor/datatable/vfs_fonts.js"></script>
<script src="resources/js/admin.js"></script>
@stop