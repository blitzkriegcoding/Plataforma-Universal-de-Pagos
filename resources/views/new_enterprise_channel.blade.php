@extends('adminlte::page')

@section('title', 'Plataforma Universal de Pagos')

@section('content_header')
    <h1>Asociar canales y empresas</h1>
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
    {!! Form::open(['route' => 'admin.create_enterprise_channel', 'method'=> 'post', 'class' => 'form-horizontal']) !!}
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
				{!!Form::label('id_canal', 'Canal a asociar:',['class' => 'col-sm-2 control-label'])!!}
				<div class="col-sm-3">
				{!! Form::select('id_canal',[] ,NULL, ['id' => 'id_canal', 'class' => 'form-control', 'placeholder' => '', 'style' => 'border-radius: 10px; line-height: 1.5']); !!}
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
