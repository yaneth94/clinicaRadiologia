@extends('layouts.app')
@section('content')
@can('asignar_citas')
<script type="text/javascript" src="{{ asset('js/fechasCitas.js')}}"></script>
<div class="container">
    <div id="loginbox" style="margin-top:30px">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">Crear Nueva Cita</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <form class="form-horizontal" role="form" method="POST" action="{{ url( '/admin_citas' ) }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> <!--Seguridad Otorgada por blade -->
                    <div class="form-group">
                            <label for="tipoExamen" class="col-md-4 control-label">Tipo de Examen</label>
                            <div class="col-md-6">
                                 <select required class="form-control" name="tipoExamen" id="tipoExamen" onchange="ponerFecha();">
                                 <option value="" disabled selected>Elije un tipo de Examen</option>
                                            @foreach($tipoExamenes as $tipoExamen)
                                            <option  value='{{ $tipoExamen->idTipoExamen }}'> {{ $tipoExamen->nombreTipoExamen }} </option>
                                        @endforeach
                                    </select>
                            </div>
                    </div>
                    <div class="form-group {{ $errors->has('fechaCita') ? ' has-error' : '' }}">
                        <label for="fechaCita" class="col-md-4 control-label">Fecha Cita</label>
                        <div class="col-md-6">
                            <input id="fechaCita" type="date" class="form-control" name="fechaCita" value="{{ old('fechaCita') }}"  required autofocus onblur="validarFecha();" >
                            @if ($errors->has('fechaCita'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fechaCita') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre_rol" class="col-md-4 control-label">Ingresar Hora</label>
                        <div class="col-md-6">
                            <input id="horaCita" type="time" class="form-control" name="horaCita" value="{{ old('fechaCita') }}" required autofocus>
                            @if ($errors->has('horaCita'))
                            <span class="help-block">
                                <strong>{{ $errors->first('horaCita') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success btn-sm">
                             <span class="glyphicon glyphicon-floppy-disk"></span>Guardar Cita
                        </button>
                         <a href="{{ url('/admin_citas') }}" class="btn btn-warning btn-sm">
                        <span class="glyphicon glyphicon-list-alt"></span>Regresar a Lista de Citas</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@else
<div class="alert alert-danger">
<strong>NO ESTÁ AUTORIZADO PARA VER ESTA PANTALLA </strong>
</div>
 @endcan
@endsection
