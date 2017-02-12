<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Acceso no autorizado</title>
	<link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
	<div class="well well-lg">
		<h3>
			Disculpe, su sesión ha expirado o no ha iniciado sesión aun... Inicie sesión <a href="{!! route('index') !!}">aquí</a>
		</h3>
	</div>
	
</body>
</html>