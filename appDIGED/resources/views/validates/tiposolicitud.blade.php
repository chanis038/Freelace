@switch($request->tipo)
        @case("PM")
        Pago de maestría
         @break
        @case ('PD')
        Pago de doctorado
         @break
        @case ('PB')
        Pago de boleto aéreo
         @break
        @case ('PV')
        Pago de viáticos
         @break                         
        @default
        Pago de boleto aéreo y viáticos
        @break
                        
@endswitch
