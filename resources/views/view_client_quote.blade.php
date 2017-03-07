@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Consulta y actualización de cuotas</h1>
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
    {!! Form::open(['route' => 'admin.create_credit', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('rut_cliente', 'RUT del Cliente: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-5">
				{!! Form::select('rut_cliente',[] ,NULL, ['id' => 'rut_cliente', 'class' => 'form-control', 'placeholder' => 'ejm. 12345678-9', 'style' => 'border-radius: 10px; line-height: 1.5']); !!}
				</div>
				{!! Form::button('Ver cuotas', ['class' => 'btn btn-primary', 'onclick' => 'getQuotes()']) !!}
			</div>
			<div class="row">				
				<br>
			</div>
			<div class="row col-sm-11">
				<div class="row col-sm-1" id="download_button"></div>			
				<div id="jsGridQuotes"></div>
			</div>
			{!! csrf_field() !!}

    	{!! Form::close() !!}
		</div>
	</div>
	@include('custom_includes.datepicker_libs')
@stop
