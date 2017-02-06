@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Carga Masiva de Créditos y Clientes</h1>
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
    {!! Form::open(['route' => 'admin.upload_credits', 'method'=> 'post', 'class' => 'form-horizontal' ,'enctype' => 'multipart/form-data']) !!}
			<div class="form-group">		    
				{!!Form::label('lote_credito', 'Archivo excel de créditos: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-4">
				{!! Form::file('lote_credito', ['id' => 'lote_credito']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
			</div>
			<div class="row">
				<div class="col-sm-1">
					<br>
				</div>					
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-offset-2 col-sm-1">
						{!! Form::submit('Subir archivo y generar créditos', ['class' => 'btn btn-primary']) !!}
					</div>						
				</div>			
			</div>

			{!! csrf_field() !!}

    	{!! Form::close() !!}
		</div>
	</div>
	@include('custom_includes.datepicker_libs')
@stop
