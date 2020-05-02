    @php
      switch ($request->tipo) {
        case 'PM'|'PD':
          # code...
           $datatype= ['label1'=> 'Duración (Años):',"valor1"=>$request->duracion,'label2'=> 'Costo inscripción:',"valor2"=>$request->costo_inscripcion,'label3'=> 'Costo de pagos:',"valor3"=>$request->costo_parcial.'('.$request->frecuencia_pago.')'];
          break;

        case 'PCC':
          # code...
           $datatype= ['label1'=> 'Duración ('.$request->tipo_duracion.'):',"valor1"=>$request->duracion,'label2'=> 'Costo inscripción:',"valor2"=>$request->costo_inscripcion,'label3'=> 'Costo de curso:',"valor3"=>$request->costo_parcial];
          break;
        
        default:
          # code...
           $datatype= ['label1'=> 'Duración ('.$request->tipo_duracion.'):',"valor1"=>$request->duracion,'label2'=> 'Lugar de evento:',"valor2"=>$request->lugar,'label3'=> 'Fecha de evento',"valor3"=>$request->fecha_viaje];
          break;
      }
          
   @endphp

      <div class="row">
             
        <div class=" col-xs-6 col-ms-6 col-md-4 ">
          <strong>{{$datatype["label1"]}}</strong> {{$datatype["valor1"]}} 
         </div> 

         <div class=" col-xs-6 col-ms-6 col-md-4 ">
           <strong>{{$datatype["label2"]}}</strong> {{$datatype["valor2" ]}}           
         </div> 

           <div class=" col-xs-6 col-ms-6 col-md-4 ">
          <strong>{{$datatype["label3"]}}</strong> {{$datatype["valor3"]}} 
          </div>                   
        </div>
        