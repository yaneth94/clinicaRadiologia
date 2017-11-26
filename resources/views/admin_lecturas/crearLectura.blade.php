@extends('layouts.app')

@section('content')
<section>
	@can('control_pacientes')
	<div class="alert alert-info" role="alert">
		<strong>Ingresar datos de Lectura </strong>
	</div>
	<div>
		@if (count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif
			@if(session()->has('msj2'))
			<div class="alert alert-danger" role="alert">{{session('msj2')}}</div>
			@endif


		</div>
		<div class="container">
			<div id="loginbox" style="margin-top:30px">
				<div class="panel panel-primary" >
					<div class="panel-heading">
						<div class="panel-title">Registrar Lectura</div>
					</div>

					<div style="padding-top:30px" class="panel-body" >

						<!--Mensaje de error -->
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

						<form class="form-horizontal" role="form" method="POST" action="{{ url( '/admin_lecturas' ) }}">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> <!--Seguridad Otorgada por blade -->


							<div class="form-group">
								<label for="tipoExamen" class="col-md-4 control-label">Tipo de Examen</label>
								<div class="col-md-6">
									<select required class="form-control" name="tipoExamen" id="tipoExamen" onchange="ocul()">
										<option value="" disabled selected>Elija una opción
										@foreach($tExamenes as $tExamen)
										<option  value='{{ $tExamen->idTipoExamen }}'> {{ $tExamen->nombreTipoExamen }} </option>
										@endforeach
									</select>
								</div>
							</div>

                            <div class="form-group">
								<label for="patologia" class="col-md-4 control-label">Patologia</label>
								<div class="col-md-2">
								<fieldset class="form-control">
									<input type="radio" id="si" name="patologia" value="v">
									<label for="si">Si</label>
									<input type="radio" id="no" name="patologia" value="f">
									<label for="no">No</label>
								</fieldset>
								</div>
							</div>
							
							<div class="form-group">
								<label for="descripcion" class="col-md-4 control-label">Descripción</label>
								<div class="col-md-6">
									<textarea id="descripcion"  class ="form-control" name="descripcion" rows="5" cols="50"></textarea>
								</div>
								
							</div>
							

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-success btn-sm">
										<span class="glyphicon glyphicon-floppy-disk"></span>Guardar Lectura
									</button>
									 <a href="{{ url('/admin_pacientes') }}" class="btn btn-warning btn-sm">
                        			<span class="glyphicon glyphicon-list-alt"></span>Regresar</a>
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
	</section>
	@endsection
