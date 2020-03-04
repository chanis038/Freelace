
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>
		<strong>{{$introduction}}:</strong>	
	</p>
	<p>
	<strong>Docente: </strong>{{' '.$owner[0]->p_nombre.' '.$owner[0]->p_apellido}}
	 
	<br><strong>Tipo: </strong>.
				@php
				 $request = $solicitud;

				@endphp
				@include('validates.tiposolicitud')
	<br><strong>Justificación:  </strong>{{$solicitud->justificacion}}

	<br><strong>Id Solicitud: </strong>SAE- {{$solicitud->id}}
	</p>
    <br>
    <br>
    <br>
	<footer>
		<strong>DIGED</strong><br>
		Mensaje automático, por favor no lo responda...
	</footer>
</body>
</html>







