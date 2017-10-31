@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive">
			<form class="form" method="get" action="/tomarIdMaterialEliminar/{{$material->idMaterial}},{{$material->idSalida}}">
     				{{ csrf_field() }}    
     	@foreach($detalleMaterial as $material)    
           <h1>Desea eliminar el tipo de Material de :{{ $material->nombreTipoMaterial}} con fecha: {{$material->fecha}} , tipo de Unidad: {{$material->nombreTipoUnidad}} y cantidad : {{$material->cantidadMaterial}}</h1>
           @endforeach
      		 <div class="form-group">
        <button  type="submit" class="btn btn-danger btn-sm "><span class="glyphicon glyphicon-trash"></span>Eliminar registro de Material</button>
        <a href="{{ route('admin_material.show',$material->idMaterial) }}" class="btn btn-warning btn-sm">
     <span class="glyphicon glyphicon-list-alt"></span></span>Cancelar</a>
    </div>
    </form>
		</div>
	</div>
	</div>
</div>
</div>
</div>

@endsection