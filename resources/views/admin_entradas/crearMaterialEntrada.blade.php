@extends('layouts.app')
@section('content')
  @can('generar_graficos')
<script type="text/javascript" src="{{ asset('js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/cargarUnidad.js')}}"></script>
<div class="container">
    <div id="loginbox" style="margin-top:30px">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">Ingresar Material</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <form class="form-horizontal" role="form" method="POST" action="{{ url( '/admin_entradas' ) }}">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> <!--Seguridad Otorgada por blade -->
                         <div class="form-group">
                            <label for="id" class="col-md-4 control-label">Nombre del Encargado del examen</label>
                            <div class="col-md-6">

                            <input type="hidden" name="idUser" value=" {{ Auth::user()->id}}">
                            <input id="nombreCompletoUser" type="text" class="form-control" name="nombreCompletoUser" value=" {{ Auth::user()->username }}" autocomplete="off" disabled="disabled">
                            </div>
                        </div>


                            <div class="form-group">
                                <label for="tipoMaterial" class="col-md-4 control-label">Tipo Material</label>
                                <div class="col-md-6">
                                    <select required class="form-control" name="tipoMaterial" id="tipoMaterial"onchange="ponerFecha();">
                                        <option value="" disabled selected>Seleccione un Tipo de Material</option>
                                        @foreach($tipoMaterial as $tipo)
                                        <option  value='{{$tipo->idTipoMaterial}}'> {{$tipo->nombreTipoMaterial}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="tipoUnidad" class="col-md-4 control-label">Unidades</label>
                                <div class="col-md-6">
                                    <select required class="form-control" name="tipoUnidad" id="tipoUnidad" onchange="ocul()">
                                        <option value="" disabled selected>Seleccione un Tipo de Unidad</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cantidadMaterial') ? ' has-error' : '' }}">
                            <label for="cantidadMaterial" class="col-md-4 control-label">Cantidad en Cajas de Material</label>

                            <div class="col-md-6">
                                <input id="cantidadMaterial" type="text" class="form-control" name="cantidadMaterial" value="{{ old('cantidadMaterial') }}" autocomplete="off" required autofocus >

                                @if ($errors->has('cantidadMaterial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cantidadMaterial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                             <div class="form-group{{ $errors->has('cantidadUnidadMaterial') ? ' has-error' : '' }}">
                            <label for="cantidadUnidadMaterial" class="col-md-4 control-label">Cantidad de Unidades de Material por Caja </label>

                            <div class="col-md-6">
                                <input id="cantidadUnidadMaterial" type="text" class="form-control" name="cantidadUnidadMaterial" value="{{ old('cantidadUnidadMaterial') }}" autocomplete="off" required autofocus>

                                @if ($errors->has('cantidadUnidadMaterial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cantidadUnidadMaterial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                            <label for="proveedor" class="col-md-4 control-label">Proveedor </label>

                            <div class="col-md-6">
                                <input id="proveedor" type="text" class="form-control" name="proveedor" value="{{ old('proveedor') }}" autocomplete="off" required autofocus>

                                @if ($errors->has('proveedor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('proveedor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                                <label for="fecha" class="col-md-4 control-label">Fecha de Compra de Material</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control" name="fecha" value="{{ old('fecha') }}"  required autofocus onblur="validarFecha();">
                                    @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>Ingresar Material
                                    </button>
                                     <a href="{{ url('/admin_entradas') }}" class="btn btn-warning btn-sm">
                                    <span class="glyphicon glyphicon-list-alt"></span>Regresar a ver Registros </a>
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
