@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Consulta de Pagos de Cuotas</h1>
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
				{!!Form::label('date_start', 'Fecha inicio:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('date_start', '', ['id' => 'date_start', 'class' => 'form-control', 'placeholder' =>'DD/MM/AAAA']); !!}		      
				</div>			
				{!!Form::label('date_end', 'Fecha final:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('date_end', '', ['id' => 'date_end', 'class' => 'form-control', 'placeholder' =>'DD/MM/AAAA']); !!}		      
				</div>	
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>

			<div class="form-group">
				<div class="row">
					<div class=" col-sm-1 col-sm-offset-2">
						{!! Form::button('Generar reporte', ['class' => 'btn btn-primary']) !!}
					</div>	
					<div id="download_button" class="col-sm-2"></div>					
				</div>			
			</div>

			{!! csrf_field() !!}

    	{!! Form::close() !!}
		</div>
	</div>	
@stop
