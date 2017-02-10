@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Creación de nuevo canal</h1>
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
    {!! Form::open(['route' => 'admin.create_channel', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
			<div class="form-group">		    
				{!!Form::label('canal', 'Nuevo canal: ',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::text('canal', '', ['id' => 'canal', 'class' => 'form-control', 'placeholder' => '123456']); !!}		      
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
