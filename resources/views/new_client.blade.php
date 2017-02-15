@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Cargar datos de un nuevo cliente</h1>
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
    {!! Form::open(['route' => 'admin.create_client', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('rut_cliente', 'RUT del Cliente: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('rut_cliente', '', ['id' => 'rut_cliente', 'class' => 'form-control', 'placeholder' => '12345678-9']); !!}		      
				</div>
				{!!Form::label('nombre_cliente', 'Nombres del Cliente:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('nombre_cliente', '', ['id' => 'nombre_cliente', 'class' => 'form-control','placeholder' => 'Juanita']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
			</div>
			<div class="form-group">		    
				{!!Form::label('apellido_cliente', 'Apellidos del cliente:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('apellido_cliente', '', ['id' => 'apellido_cliente', 'class' => 'form-control', 'placeholder' => 'Pérez']); !!}		      
				</div>

				{!!Form::label('telefono_cliente', 'Teléfono del Cliente:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('telefono_cliente', '', ['id' => 'telefono_cliente', 'class' => 'form-control', 'placeholder' =>'+56(2)23456789']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">		    
				{!!Form::label('email_cliente', 'Email del Cliente:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('email_cliente', '', ['id' => 'email_cliente', 'class' => 'form-control', 'placeholder' =>'email_cliente@mail.com']); !!}		      
				</div>
				{!!Form::label('id_empresa', 'Empresa a asociar: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::select('id_empresa',[] ,NULL, ['id' => 'id_empresa', 'class' => 'form-control', 'placeholder' => '', 'style' => 'border-radius: 10px; line-height: 1.5']); !!}
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">
				{!!Form::label('direccion_cliente', 'Dirección del cliente:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::textarea('direccion_cliente','' ,['id' => 'direccion_cliente', 'rows' => 4, 'cols'=>35, 'placeholder' => 'Miraflores 321, Edf Marsella, Piso 1, Local 1-A "Los Pellines"' ]); !!}
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>		  	
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{!! Form::submit('Guardar datos', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! csrf_field() !!}
    	{!! Form::close() !!}
		</div>
	</div>		    
@stop
