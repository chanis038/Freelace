+( function(){

   function viewMaestriaDoctorado(){
          var pagosf = ["mensual","bimestral","trimestral","semestral","anual"];
          
          var  
            div = document.getElementById("datos"),
            divrow = document.createElement("div"),
            divrow2 = document.createElement("div"),
            divcol = document.createElement("div"),
            divcol2 = document.createElement("div"),
            divcol3 = document.createElement("div"),
            divcol4 = document.createElement("div"),

            lInscripcion = document.createElement("label"),
            inscripcion = document.createElement("input"),
            lduracion = document.createElement("label"),
            duracion = document.createElement("input"),
            lfrecuencia = document.createElement("label"),
            frecuencia = document.createElement("select"),
            lfcantidad = document.createElement("label"),
            fcantidad = document.createElement("input");


            divrow.className='row';
            divrow2.className='row';
            divcol.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol2.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol3.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol4.className='col-xs-6 col-ms-6 col-md-3 mb-3';

            lduracion.innerHTML ='Duracion (Años)';
            lduracion.for="duracion";    

            duracion.className='form-control';
            duracion.name='duracion';
            duracion.type='number';
            duracion.maxlength=1;
            duracion.max="5"; 
            duracion.min="1";
            duracion.required= true;
            duracion.id='duracion';
            //duracion.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            duracion.title="El campo solo numeros enteros y decimal con 1 digitos";
            if(fill){
            duracion.value= datafill.duracion;
            }

            lInscripcion.innerHTML ='Costo de inscripción';
            lInscripcion.for="costo_inscripcion";    

            inscripcion.name='costo_inscripcion';
            inscripcion.className='form-control';
            inscripcion.type='text';
            inscripcion.maxlength=12;
            //duracion.min="1";.
            inscripcion.required= true;
            inscripcion.id='costo_inscripcion';
            inscripcion.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            inscripcion.title="El campo solo numeros enteros y decimal con 12 digitos";
             if(fill){
            inscripcion.value= datafill.costo_inscripcion;
            }
            
            lfrecuencia.innerHTML ='Frecuencia de pago';
            lfrecuencia.for="frecuencia_pago"; 

            frecuencia.name='frecuencia_pago';
            frecuencia.className='custom-select d-block w-80';
            //frecuencia.type='text';

            pagosf.forEach(function (elemento, array) {
            var option = document.createElement("option");
            option.innerHTML= elemento;
            option.value= elemento;
            if(fill && elemento == datafill.frecuencia_pago){
            option.selected= true;
                 }
            frecuencia.appendChild(option);
             });

            lfcantidad.innerHTML ='Cantidad';
            lfcantidad.for="costo_parcial";    

            fcantidad.name='costo_parcial';
            fcantidad.className='form-control';
            fcantidad.type='text';
            fcantidad.maxlength=12;
            //fcantidad.min="1";
            fcantidad.required= true;
            fcantidad.id = 'costo_parcial';
            fcantidad.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            fcantidad.title="El campo solo numeros enteros y decimal con 12 digitos";
            if(fill){
            fcantidad.value= datafill.costo_parcial;
            }

            
            divcol.appendChild(lduracion);
            divcol.appendChild(duracion);
            divcol2.appendChild(lInscripcion);
            divcol2.appendChild(inscripcion); 
            divcol3.appendChild(lfrecuencia);
            divcol3.appendChild(frecuencia);
            divcol4.appendChild(lfcantidad);
            divcol4.appendChild(fcantidad);

            divrow.appendChild(divcol);
            divrow.appendChild(divcol2);
            divrow2.appendChild(divcol3);
            divrow2.appendChild(divcol4);
            div.appendChild(divrow);
            div.appendChild(divrow2);

     }   

       function viewCurso(){
          var pagosf = ["semanas","meses"];
          
          var  
            div = document.getElementById("datos"),
            divrow = document.createElement("div"),
            divrow2 = document.createElement("div"),
            divcol = document.createElement("div"),
            divcol2 = document.createElement("div"),
            divcol3 = document.createElement("div"),
            divcol4 = document.createElement("div"),

            lduracion = document.createElement("label"),
            duracion = document.createElement("input"),
            lfrecuencia = document.createElement("label"),
            frecuencia = document.createElement("select"),
            lInscripcion = document.createElement("label"),
            inscripcion = document.createElement("input"),
            lfcantidad = document.createElement("label"),
            fcantidad = document.createElement("input");


            divrow.className='row';
            divrow2.className='row';
            divcol.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol2.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol3.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol4.className='col-xs-6 col-ms-6 col-md-3 mb-3';

            lduracion.innerHTML ='Duracion';
            lduracion.for="duracion";    

            duracion.className='form-control';
            duracion.name='duracion';
            duracion.type='number';
            duracion.maxlength=1;
            duracion.max="5"; 
            duracion.min="1";
            duracion.required= true;
            duracion.id='duracion';
            //duracion.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            duracion.title="El campo solo numeros enteros y decimal con 1 digitos";
            if(fill){
            duracion.value= datafill.duracion;
            }

            lfrecuencia.innerHTML ='';
            lfrecuencia.for="tipo_duracion"; 

            frecuencia.name='tipo_duracion';
            frecuencia.className='custom-select d-block w-60';
            //frecuencia.type='text';

            pagosf.forEach(function (elemento, array) {
            var option = document.createElement("option");
            option.innerHTML= elemento;
            option.value= elemento;
             if(fill && elemento == datafill.tipo_duracion){
            option.selected= true;
                 }
            frecuencia.appendChild(option);
            });

            lInscripcion.innerHTML ='Costo de inscripción';
            lInscripcion.for="costo_inscripcion";    

            inscripcion.name='costo_inscripcion';
            inscripcion.className='form-control';
            inscripcion.type='text';
            inscripcion.maxlength=12;
            //duracion.min="1";
            inscripcion.required= true;
            inscripcion.id ='costo_inscripcion';
            inscripcion.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            inscripcion.title="El campo solo numeros enteros y decimal con 12 digitos";
             if(fill){
            inscripcion.value= datafill.costo_inscripcion;
            }

            
            lfcantidad.innerHTML ='Costo ';
            lfcantidad.for="costo_parcial";    

            fcantidad.name='costo_parcial';
            fcantidad.className='form-control';
            fcantidad.type='text';
            fcantidad.maxlength=12;
            //fcantidad.min="1";
            fcantidad.required= true;
            fcantidad.id='costo_parcial';
            fcantidad.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            fcantidad.title="El campo solo numeros enteros y decimal con 12 digitos";
             if(fill){
            fcantidad.value= datafill.costo_parcial;
            }

            divcol.appendChild(lduracion);
            divcol.appendChild(duracion);
            divcol3.appendChild(lInscripcion);
            divcol3.appendChild(inscripcion); 
            divcol2.appendChild(lfrecuencia);
            divcol2.appendChild(frecuencia);
            divcol4.appendChild(lfcantidad);
            divcol4.appendChild(fcantidad);

            divrow.appendChild(divcol);
            divrow.appendChild(divcol2);
            divrow2.appendChild(divcol3);
            divrow2.appendChild(divcol4);
            div.appendChild(divrow);
            div.appendChild(divrow2);

     }    

      function viewBoletoViaticos(){
            var pagosf = ["dias","semanas","meses"];
          var  
            div = document.getElementById("datos"),
            divrow = document.createElement("div"),
            divrow2 = document.createElement("div"),
            divcol = document.createElement("div"),
            divcol2 = document.createElement("div"),
            divcol3 = document.createElement("div"),
            divcol4 = document.createElement("div"),

            lduracion = document.createElement("label"),
            duracion = document.createElement("input"),
            lfrecuencia = document.createElement("label"),
            frecuencia = document.createElement("select"),
            llugar = document.createElement("label"),
            lugar = document.createElement("input"),
            lfecha = document.createElement("label"),
            fecha = document.createElement("input");

            divrow.className='row';
            divrow2.className='row';
            divcol.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol2.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol3.className='col-xs-6 col-ms-6 col-md-3 mb-3';
            divcol4.className='col-xs-6 col-ms-6 col-md-3 mb-3';

            lduracion.innerHTML ='Duracion';
            lduracion.for="duracion";    

            duracion.className='form-control';
            duracion.name='duracion';
            duracion.type='number';
            duracion.maxlength=1;
            //duracion.max="5"; 
            duracion.min="1";
            duracion.required= true;
            lduracion.id='duracion';
            //duracion.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            duracion.title="El campo solo numeros enteros y decimal con 1 digitos";
            if(fill){
            duracion.value= datafill.duracion;
            }


            lfrecuencia.innerHTML ='';
            lfrecuencia.for="tipo_duracion"; 

            frecuencia.name='tipo_duracion';
            frecuencia.className='custom-select d-block w-60';
            //frecuencia.type='text';

            pagosf.forEach(function (elemento, array) {
            var option = document.createElement("option");
            option.innerHTML= elemento;
            option.value= elemento;
            if(fill && elemento == datafill.tipo_duracion){
            option.selected= true;
                 }
            frecuencia.appendChild(option);
            });

            llugar.innerHTML ='Lugar de Evento';
            llugar.for="lugar";    

            lugar.name='lugar';
            lugar.className='form-control';
            lugar.type='text';
            lugar.pattern="[0-9a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\\s]{2,100}";
            lugar.title="El campo solo permite letras y numeros"; 
            lugar.id='lugar';
            //lugar.maxlength=12;
            if(fill){
            lugar.value= datafill.lugar;
            }


            lfecha.innerHTML ='Fecha de viaje';
            lfecha.for="fecha_viaje";    

            fecha.name='fecha_viaje';
            fecha.className='form-control';
            fecha.type='date';
            fecha.id='fecha_viaje';
            if(fill){
            fecha.value= datafill.fecha_viaje;
            }
           // fecha.maxlength=12;
            //fcantidad.min="1";
           // fcantidad.pattern="[0-9]{2,20}([\.,][0-9]{2})?";
            //fecha.title="El campo solo numeros enteros y decimal con 12 digitos";

            divcol.appendChild(lduracion);
            divcol.appendChild(duracion);
            divcol2.appendChild(lfrecuencia);
            divcol2.appendChild(frecuencia);
            divcol3.appendChild(llugar);
            divcol3.appendChild(lugar);
            divcol4.appendChild(lfecha);
            divcol4.appendChild(fecha); 

            divrow.appendChild(divcol);
            divrow.appendChild(divcol2);
            divrow2.appendChild(divcol3);
            divrow2.appendChild(divcol4);
            div.appendChild(divrow);
            div.appendChild(divrow2);

     } 

     function starCreateRequest(){
        //var selected = document.getElementById('tipo');
          div = document.getElementById("datos");

          if(selected.value == 'PD' | selected.value == 'PM'){
            if(estado != 0){
                div.innerHTML='';
                viewMaestriaDoctorado(); 
                estado=0;
            }
          }
          else if(selected.value == 'PCC' ){
            if(estado != 1){
                div.innerHTML='';
                viewCurso();
                estado=1;
            }
          }
          else if(selected.value == 'PB' | selected.value == 'PV' | selected.value == 'PBV'){
            if(estado != 2){
                div.innerHTML='';
                viewBoletoViaticos();
                estado=2;
            }
          }

     }   

     var validateform = function (e){

        var fecha_viaje =document.getElementById('fecha_viaje');
            fechav = moment(fecha_viaje.value),
            hoy = new Date(),
            fecha_actual = moment(hoy.getFullYear()+'-'+(hoy.getMonth()+1)+'-'+hoy.getDate());
            dias = fechav.diff(fecha_actual,'days');
            if(!fill && dias <= 29){

            fecha_viaje.setCustomValidity("Para solicitar boleto areo tiene que ser con 30 dias de anticipacion");
            fecha_viaje.focus();
            e.preventDefault();
            }
            
            

            console.log(fecha_actual +' '+ fechav+' '+dias);
     }

    var selected = document.getElementById('tipo'),
        estado =5 ,
        solicitud = document.getElementById('solicitud');

        selected.addEventListener('change',starCreateRequest);

        solicitud.addEventListener('submit',validateform);
      starCreateRequest();
      
        
  })();

      