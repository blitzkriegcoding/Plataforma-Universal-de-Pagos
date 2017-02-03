@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Generación de un nuevo crédito</h1>
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
				<div class="col-sm-4">
				{!! Form::select('rut_cliente',[] ,NULL, ['id' => 'rut_cliente', 'class' => 'form-control', 'placeholder' => 'ejm. 12345678-9', 'style' => 'border-radius: 10px; line-height: 1.5']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
			</div>
		
			<div class="form-group">
				{!!Form::label('paquete', 'Nombre del Crédito:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('paquete', '', ['id' => 'paquete', 'class' => 'form-control','placeholder' => 'ejm. CAMPAÑA TASA']); !!}		      
				</div>

				{!!Form::label('cantidad_cuotas', 'Cantidad de cuotas:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('cantidad_cuotas', '', ['id' => 'cantidad_cuotas', 'class' => 'form-control', 'placeholder' => 'ejm. 24','maxlength' =>'4']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">
				{!!Form::label('fecha_vencimiento', 'Vencimiento del contrato:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('fecha_vencimiento', '', ['id' => 'fecha_vencimiento', 'class' => 'form-control', 'placeholder' =>'DD/MM/AAAA']); !!}		      
				</div>			
				{!!Form::label('total_credito', 'Monto total crédito:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('total_credito', '', ['id' => 'total_credito', 'class' => 'form-control', 'placeholder' =>' ejm. 10.000.000']); !!}		      
				</div>

				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">
				{!!Form::label('nro_credito', 'Número de Crédito:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('nro_credito', '', ['id' => 'nro_credito', 'class' => 'form-control', 'placeholder' =>'ejm. 691', 'maxlength' => 8]); !!}		      
				</div>					    
				{!!Form::label('interes_diario', 'Interés diario (%):',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('interes_diario', '', ['id' => 'interes_diario', 'class' => 'form-control', 'placeholder' =>' ejm. 2.5']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>	
				<div class="col-sm-1">
					<br>
				</div>										
		  	</div>
			<div class="form-group">
				{!!Form::label('interes_mensual', 'Interés mensual (%):',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('interes_mensual', '', ['id' => 'interes_mensual', 'class' => 'form-control', 'placeholder' =>'ejm. 0.1']); !!}		      
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
					<div class="col-sm-offset-4 col-sm-1">
						{!! Form::button('Generar borrador', ['class' => 'btn btn-warning']) !!}
					</div>	
					<div class="col-sm-offset-1 col-sm-1">
						{!! Form::submit('Generar crédito', ['class' => 'btn btn-primary']) !!}
					</div>						
				</div>			
			</div>

			{!! csrf_field() !!}

    	{!! Form::close() !!}
		</div>
	</div>
	@include('custom_includes.datepicker_libs')
@stop
