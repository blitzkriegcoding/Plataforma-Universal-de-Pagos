@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Listado de clientes</h1>
	@if (count($errors) > 0)
		<div class="container">
			<div class="row">
				<br>
			    <div class="alert alert-danger col-sm-6 col-md-6">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
		    </div>
		</div>
	@endif
 
@stop

@section('content')
@include('flashes.user_message')
	<div class="container">
		<div class="row">
			<div class="row">
				<br>
			</div>
			<div class="row">
				<div class="container col-sm-11">
					<div id="jsGrid">
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('custom_includes.datepicker_libs')
@stop
