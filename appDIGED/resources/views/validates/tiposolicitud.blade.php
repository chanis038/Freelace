@switch($request->tipo)
        @case("PM")
        Pago de Maestría
         @break
        @case ('PD')
        Pago de Doctorado
         @break
        @case ('PB')
        Pago de Boleto Aéreo
         @break
        @case ('PV')
        Pago de Viáticos
         @break                         
        @default
        Pago de Boleto Aéreo y Viáticos
        @break
                        
@endswitch
