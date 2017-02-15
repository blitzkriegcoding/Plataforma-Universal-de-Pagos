@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Cargar datos de un nuevo usuario</h1>
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
    {!! Form::open(['route' => 'admin.create_user', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('rut_usuario', 'RUT del usuario: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('rut_usuario', '', ['id' => 'rut_usuario', 'class' => 'form-control', 'placeholder' => '12345678-9', 'style' =>'text-transform: uppercase;']); !!}		      
				</div>
				{!!Form::label('name', 'Nombres del Usuario:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control','placeholder' => 'Juanita', 'style' =>'text-transform: uppercase;']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
			</div>
			<div class="form-group">		    
				{!!Form::label('password', 'Password:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => '*****']); !!}		      
				</div>

				{!!Form::label('password_confirmation', 'Confirme password:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' =>'******']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">		    
				{!!Form::label('email', 'Email usuario:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' =>'email_cliente@mail.com']); !!}		      
				</div>
				{!!Form::label('active', 'Usuario activo: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::select('active',[ '1' => 'SI', '0' => 'NO'] ,NULL, ['id' => 'active', 'class' =>'col-sm-12' ,'placeholder' => 'SELECCIONE']); !!}
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">
				{!!Form::label('id_empresa', 'Empresa a asociar: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::select('id_empresa',[] ,NULL, ['id' => 'id_empresa', 'class' => 'form-control', 'placeholder' => '', 'style' => 'border-radius: 10px; line-height: 1.5']); !!}
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
