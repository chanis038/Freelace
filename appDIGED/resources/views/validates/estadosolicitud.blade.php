@switch($request->estado)
	@case ('EN')
		Enviado a revisión
		@break

	@case ('AP')
		Revisión aprobada
		@break

	@case ('AT')
	    Autorizada (sin Acuerdo)
		@break

	@case ('ET')
	    Enviado a tesorería
		@break
		
	@case ('LT')
	    Lista para recoger
		@break

	@case ('NA')
			Rechazada
		@break

	@case ('AA')
	    Autorizada
		@break
	                        	
	@default
		Entregada
		@break
@endswitch