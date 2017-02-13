@extends('adminlte::page')
@section('title', 'Plataforma Universal de Pagos')
@section('content_header')
    <h1>Preeliminar de carga masiva de créditos</h1>
@stop
@section('content')
@include('flashes.user_message')
	<div class="container">
		<div class="row col-sm-6 col-sm-offset-2">
{{-- 			<div class="alert alert-warning alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>ATENCIÓN! </strong>Tiene que autorizar o reversar la operación de carga para que se vea reflejada en la base de datos.
			</div> --}}
			<table class="table table-bordered table-hover">
				<th class="info" colspan="2" class="text-center">
					Resumen de carga
				</th>				
				<tr class="info">
					<td width="60%" class="text-info">
						Total de registros en el archivo: 
					</td>
					<td width="40%">
						{{ session('nro_registros') }}
					</td>
				</tr>																									
			</table>								
		</div>
		<div class="row col-sm-8 col-sm-offset-3">					
			<a href="{{ route('admin.rollback_upload') }} " class="btn btn-danger">Reversar la carga del lote</a> <a href="{{ route('admin.commit_upload') }}" class="btn btn-success">Confirmar la carga del lote</a>
		</div>
		<div class="row">
			<br> <br>
		</div>
		<div class="container">
			<div class="row">
				<br>
			</div>
			<div id="jsGridEditLote"></div>
		</div>
		<div class="row">
			<br>
		</div>		
	</div>	
@stop
