@extends('adminlte::page')
@section('title', 'Plataforma Universal de Pagos')
@section('content_header')
    <h1>Histórico de carga de créditos</h1>
@stop
@section('content')
@include('flashes.user_message')
	<div class="container">
			<div class="row col-sm-11 ">
			    <table class="table table-bordered" id="users-table">
			        <thead>
			            <tr>
			                <th>N° Carga</th>
			                <th>Fecha y Hora</th>			                
			                <th>Cantidad de Registros</th>
			                <th>Empresa</th>
			                <th>Usuario</th>			                
			            </tr>
			        </thead>
			    </table>
			<div class="row col-sm-8 col-sm-offset-3">					
				<a href="{{ route('admin.rollback_upload') }} " class="btn btn-danger">Reversar la carga del lote</a> <a href="{{ route('admin.commit_upload') }}" class="btn btn-success">Confirmar la carga del lote</a>
			</div>
	</div>	
@stop
