@extends('adminlte::page')
@section('title', 'Plataforma Universal de Pagos')
@section('content_header')
    <h1>Histórico de carga de créditos</h1>
@stop
@section('content')
@include('flashes.user_message')
	<div class="container">
		<div class="row">					
			<br>
		</div>	
		<div class="row col-sm-11 ">
			<div id="jsGridUploadHistory"></div>
		</div>
		<div class="row">					
			<br>
		</div>		
	</div>	
@stop
