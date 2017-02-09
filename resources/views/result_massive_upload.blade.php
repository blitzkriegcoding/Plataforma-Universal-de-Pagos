@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Resultado de carga masiva de créditos</h1>
@stop

@section('content')
@include('flashes.user_message')
	<div class="container">
			<div class="row col-sm-6 col-sm-offset-2">		
				<table class="table table-bordered table-hover">
					<tr class="info">
						<td width="60%" class="text-info">
							Total de registros en el archivo: 
						</td>
						<td width="40%">
							{{ session('total_data_lote') }}
						</td>
					</tr>
					<tr class="info">
						<td width="60%" class="text-info">
							Total de clientes cargados: 
						</td>
						<td width="40%">
							{{ session('total_new_clients') }}
						</td>
					</tr>
					<tr class="info">
						<td width="60%" class="text-info">
							Total de créditos cargados: 
						</td>
						<td width="40%">
							{{ session('total_credit_plans') }}
						</td>
					</tr>
					<tr class="info">
						<td width="60%" class="text-info">
							Total de cuotas cargadas: 
						</td>
						<td width="40%">
							{{ session('total_new_quotes') }}
						</td>
					</tr>
					<tr class="info">
						<td width="60%" class="text-info">
							Fecha y hora de carga: 
						</td>
						<td width="40%">
							{{ session('fecha_hora_carga') }}
						</td>
					</tr>																									
				</table>								
			</div>
			<div class="row col-sm-4 col-sm-offset-3">					
				<a href="{{ route('admin.massive_upload_credits') }}" class="btn btn-primary">Regresar a la carga masiva</a> <a href="#" class="btn btn-success">Ver registros cargados</a>
			</div>

	</div>
	@include('custom_includes.datepicker_libs')
@stop
