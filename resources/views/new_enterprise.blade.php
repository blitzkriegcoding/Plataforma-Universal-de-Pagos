@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Cargar datos de la nueva empresa</h1>
@stop

@section('content')
<div class="container">
	<div class="row">		
    {!! Form::open(['route' => 'admin.create_enterprise', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('nombre_empresa', 'Nombre de la empresa: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('nombre_empresa', '', ['id' => 'nombre_empresa', 'class' => 'form-control']); !!}		      
				</div>
				{!!Form::label('nombre_fantasia', 'Nombre de fantasía:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('nombre_fantasia', '', ['id' => 'nombre_fantasia', 'class' => 'form-control']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
			</div>
			<div class="form-group">		    
				{!!Form::label('email_empresa', 'Email empresa:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('email_empresa', '', ['id' => 'email_empresa', 'class' => 'form-control']); !!}		      
				</div>

				{!!Form::label('rut_empresa', 'RUT Empresa:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('rut_empresa', '', ['id' => 'rut_empresa', 'class' => 'form-control']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">		    
				{!!Form::label('ruta_callback', 'Ruta Callback:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('ruta_callback', '', ['id' => 'ruta_callback', 'class' => 'form-control']); !!}		      
				</div>
				{!!Form::label('rut_empresa', 'Ruta H2H: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('rut_empresa', '', ['id' => 'rut_empresa', 'class' => 'form-control']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">		    
				{!!Form::label('archivo_clave_publica', 'Archivo llave pública:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::file('archivo_clave_publica', ['id' => 'archivo_clave_publica']); !!}		      
				</div>
				{!!Form::label('archivo_llave_privada', 'Archivo llave privada: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::file('archivo_llave_privada', ['id' => 'archivo_llave_privada']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">
				{!!Form::label('ruta_imagen_empresa', 'Logo de la empresa: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::file('ruta_imagen_empresa', ['id' => 'ruta_imagen_empresa']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>						
		  	</div>
			<div class="form-group">
					<br>
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
