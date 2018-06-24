@extends('layouts/admin') {{-- Load the simple layout --}}
@section('css')
<link rel="stylesheet" href="resources/vendor/datatable/datatables.min.css" />
<link rel="stylesheet" href="resources/vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="resources/css/admin.css" />
@stop
@section('body')
<!-- Modal Delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-pagelines"></i> {{$app_name}}</h5>
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
<!-- Modal Status -->
<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-pagelines"></i> {{$app_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label class="control-label col-md-12" for="hist-text"><strong>Nota</strong></label>
            <input class="form-control col-md-12" type="text" name="hist-text" id="hist-text" maxlength="50" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btn-status-accept">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Status -->
<!-- Modal Event -->
<div class="modal fade modal-md" id="modal-event" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-pagelines"></i> {{$app_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-event">
            <input type="hidden" id="id" name="id" value="0" />
            <div class="form-group col-md-12">
                <span class="col-md-1"><i class="fa fa-user fa-2x"></i></span>
                <span class="col-md-6" id="user"></span>
                <span class="col-md-5 text-right text-danger" id="date_c"></span>
            </div>
            <div class="form-group">
                <label class="control-label col-md-12 text-info" for="name"><strong>Nombre</strong></label>
                <input class="form-control col-md-12" type="text" id="name" name="name" maxlength="50" />
                <label class="control-label col-md-12 text-info" for="type"><strong>Tipo</strong></label>
                <select id="type" name="type" class="form-control">
                @foreach($types as $type)
                    @if ( $lang == 'es')
                        <option value="{{$type->get_id()}}">{{$type->get_nameES()}}</option>
                    @else if ( $lang == 'eu')
                        <option value="{{$type->get_id()}}">{{$type->get_nameEU()}}</option>
                    @endif
                @endforeach
                </select>
                <label class="control-label col-md-12 text-info" for="description"><strong>Descripción</strong></label>
                <textarea class="form-control col-md-12" rows="3" maxlength="255" id="description" name="description"></textarea>
            </div>   
            <div class="col-md-12">
                <div id="chart"></div>
            </div>
            <div id="thumbnails" class="form-group">
                <ul>
                </ul>
            </div>
            <div class="form-group">
                <div class="col-md-12 text-right">
                    <i class="fa fa-map fa-x2"></i> <a id="map-link" target="_blank" href="#">Ver localización exacta</a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btn-event-accept">Aceptar</button>
    </div>
    </div>
  </div>
</div>
<!-- Modal Event -->
<div class="container">

    <header>
        <img src="resources/img/logo.png" alt="" />
        <div class="col-md-12 text-right">
            <h4 class="text-info">Administrador de Incidencias</h4>
            <a class="btn btn-info" href="/login/logout">
                <i class="fa fa-bed"></i> Salir
            </a>
        </div>
    </header>

    <table class="table table-striped table-responsive" id="table-events">
        <thead>
            <tr>
                <th>Id</th>
                <th>Alta</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Modificada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr data-id="{{$event->get_id()}}" data-lat="{{$event->get_lat()}}" data-lng="{{$event->get_lng()}}">
                <td>{{$event->get_id()}}</td>
                <td>{{$event->get_date_c()->format( DATETIME_FORMAT)}}</td>
                <td>{{$event->get_name()}}</td>
                <td>{{$event->get_description()}}</td>
                <td data-id="{{$event->get_type()->get_id()}}">{{$event->get_type()->get_nameES()}}</td>
                <td><a href="mailto:{{$event->get_user()->get_email()}}">{{$event->get_user()->get_name()}}</a></td>
                <td>
                    {{$event->get_status()->get_progress()}}% <span>{{$event->get_status()->get_nameES()}}</span>
                    <div class="progress">
                        <div class="progress-bar @if( $event->get_status()->get_progress() < 30 ) bg-danger
                                             @elseif( $event->get_status()->get_progress() < 100 ) bg-warning 
                                             @else bg-success
                                             @endif  progress-bar-striped active" style="width: {{$event->get_status()->get_progress()}}%;"></div>
                    </div>
                </td>               
                <td>{{$event->get_date_m()->format( DATETIME_FORMAT)}}</td>
                <td style="width: 250px;">
                    <button class="btn btn-outline-success btn-show"  data-toggle="modal" data-target="#modal-event"  data-id="{{$event->get_id()}}"><i class="fa fa-eye"></i></button>
                    <button class="btn btn-outline-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$event->get_id()}}"><i class="fa fa-eraser"></i></button>                    
                    
                    <div><strong>Situación</strong> <i class="fa fa-thermometer-half"></i></div>
                    <select class="form-control select" data-id="{{$event->get_id()}}">
                    @foreach($status as $statu)
                        <option value="{{$statu->get_id()}}" data-progress="{{$statu->get_progress()}}" @if( $statu->get_id() == $event->get_status()->get_id() ) selected  @endif> 
                        {{$statu->get_nameES()}}
                    </option>
                    @endforeach
                    </select>    
                                 
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="resources/vendor/holdon/HoldOn.min.js"></script>
<script src="resources/js/admin.js"></script>
@stop