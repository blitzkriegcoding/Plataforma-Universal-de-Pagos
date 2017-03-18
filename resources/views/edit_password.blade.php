@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Editar password del usuario {{ Auth::user()->name }} </h1>
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
    {!! Form::open(['route' => 'admin.update_password', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('old_password', 'Contraseña anterior:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::password('old_password', ['id' => 'old_password', 'class' => 'form-control', 'placeholder' => '*****']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">		    
				{!!Form::label('password', 'Nueva contraseña:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => '*****']); !!}		      
				</div>
				<div class="col-sm-1">
					<br>
				</div>
			</div>
			<div class="form-group">		    
				{!!Form::label('password_confirmation', 'Confirme contraseña:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' =>'******']); !!}		      
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
