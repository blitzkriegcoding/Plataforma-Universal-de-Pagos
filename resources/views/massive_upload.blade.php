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
    {!! Form::open(['route' => 'admin.upload_credits', 'method'=> 'post', 'class' => 'form-horizontal', 'id'=>'form_uploader', 'name'=>'form_uploader', 'enctype' => 'multipart/form-data']) !!}
			<div id="upload_controls">
				<div class="form-group">		    
					{!!Form::label('tipo_archivo', 'Tipo de archivo a cargar: ',['class' => 'col-sm-2 control-label'])!!}
					<div class="col-sm-3">
					{!! Form::select('tipo_archivo',['txt' => 'Archivo CSV', 'xls' => 'Archivo Excel'] ,NULL, ['id' => 'tipo_archivo',  'placeholder' => 'Seleccione el tipo de archivo a cargar']); !!}
					</div>
					<div class="col-sm-1">
						<br>
					</div>						
				</div>			
				<div class="form-group">		    
					{!!Form::label('lote_credito', 'Archivo de créditos: ',['class' => 'col-sm-2 control-label'])!!}
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
			</div>
			<div class="row" id="spinner" style="display: none">
				<div class="col-sm-offset-2 col-sm-1" >
					<div class="loader" ></div>
					<div class="row">
						<h4>
							Cargando archivo...
						</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1">
					<br>
				</div>					
			</div>			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-offset-2 col-sm-1" id="actions">
						{!! Form::button('Subir archivo y generar créditos', ['class' => 'btn btn-primary', 'onclick' => 'sendToServer()', 'id' => 'upload_button', 'name' => 'upload_button']) !!}
					</div>
				</div>
			</div>

			{!! csrf_field() !!}

    	{!! Form::close() !!}
		</div>
	</div>
	@include('custom_includes.datepicker_libs')
@stop
