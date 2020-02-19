@switch($request->estado)
	@case ('EN')
		Enviado a Revision
		@break

	@case ('AP')
		Revision Aprobada
		@break

	@case ('AT')
	    Autorizado
		@break

	@case ('ET')
	    Enviado a Tesoreria
		@break
		
	@case ('LT')
	    Listo para recoger
		@break

	@case ('NA')
	    Listo
		@break

	@case ('AA')
	    Autorizado
		@break
	                        	
	@default
		Entregado
		@break
@endswitch