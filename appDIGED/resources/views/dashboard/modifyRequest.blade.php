@extends('commons.dashboardtemplate')

@section('title')
    Modificar
@endsection

@section('customs')
<link href="{{asset('Plugins/css/dashboard.css')}}" type="text/css" rel="stylesheet">
<link href="{{asset('Plugins/dropzone/dist/min/dropzone.min.css')}}" type="text/css" rel="stylesheet" />

@endsection

@section('contentDash')

        <main role="main" class="container" id="dashmain">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
       
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Modificar Solicitud SAE-{{$datarequest[0]->id}}</h6>
          <small>Ingreso de informacion para la modificación de solicitud</small>
        </div>
      </div>

      <form name="Solicitud" method="POST"  action="{{ route ('modifyRequest')}}" >
        {{csrf_field()}}
        <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Informacion  Para La Solicitud De Ayuda Economica </h6>
        <div class="row">
        <div>
        <input type="hidden" name="slug" value="{{ $datarequest[0]->slug }}">
        </div>
      <div class=" col-xs-6 col-ms-6 col-md-4 mb-3">
                <label for="tipo">Tipo de Solicitud</label>
                <select class="custom-select d-block w-100" name="tipo" id='tipo' value='PD'>
                  <option value="PM"{{$datarequest[0]->tipo=="PM"?'Selected':''}}>Pago de Maestría</option>
                  <option value="PD" {{$datarequest[0]->tipo=="PD"?'Selected':''}}>Pago de Doctorado</option>
                  <option value="PB" {{$datarequest[0]->tipo=="PB"?'Selected':''}}>Pago de Boleto Aéreo</option>
                  <option value="PV" {{$datarequest[0]->tipo=="PV"?'Selected':''}}>Pago de Viáticos</option>
                  <option value="PBV" {{$datarequest[0]->tipo=="PBV"?'Selected':''}}>Pago de Boleto Aéreo y Viaticos</option>
                </select>
                </div>
                </div>
                <div class="row">
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                <label for="monto">Monto (Q)</label>
                <input type="text" class="form-control" name="monto" placeholder="" value="
                {{$datarequest[0]->monto}}" maxlength="12" required>
                </div>

               <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                <label for="monto_letras">Monto en Letras</label>
                <input type="text" class="form-control" name="monto_letras" placeholder="" value="{{$datarequest[0]->monto_letras}}" maxlength=191 required>
               </div>
              </div>

       <div class="row">
      
               <div class=" col-xs-6 col-ms-6 col-md-8 mb-3">
                <label for="justificacion">Justificaion de la Ayuda</label>
                <textarea   class="form-control" name="justificacion"  maxlength=191>{{$datarequest[0]->justificacion}}</textarea>
               </div>
        </div>   


  </div>


      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">
        Archivos Requeridos Para la Solicitud </h6>
       
               <div class=" col-xs-6 col-ms-6 col-md-8 mb-1 mt-2">
               <div class="dropzone"  id="mydropzone"  name='mydropzone'>
                 {{csrf_field()}}
                 <div class="dz-message">
                  <h6>
                   <strong>Arrastre sus archivos aqui.!!! </strong> <br>
                  </h6>                   
                 
                 </div>
                 <div class="dropzone-previews">
                 </div>
                
                </div>
                 </div>
                <div class=" col-xs-6 col-ms-6 col-md-8 mb-1">
                  <span class="text-sm-left">
                    Los archivos requeridos son:<br>
                     1. Fotocopia de DPI (ambos lados)<br>
                     2. Fotocopia de ultimo voucher de pago <br>
                     3. carta de invitacion al evento ó trifoliar informativo de maestria o doctorado.
                   </span>
            </div>
            </div> 

         <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit"  id= "sentrequest" name="sentrequest" >Guardar Cambios</button>
    </form>   
      
    </main>


@endsection

@section('scripts')
<script src="{{asset('Plugins/dropzone/dist/min/dropzone.min.js')}}">
        </script>

     <script type="text/javascript">  

        Dropzone.options.mydropzone= {
          url: "{{route('loadFiles')}}",
          paramName: "file",           
          method: 'post',
          acceptedFiles: '.jpg,.pdf',
          uploadMultiple: true,
          addRemoveLinks: true,
          timeout: 360000,
          dictRemoveFile:'Eliminar Archivo' ,
          dictInvalidFileType: 'Tipo de Archivo no permitido, solo se permiten extensiones JPG y PDF',
          
          init: function(){


            var mydrop = this , sendrequest= document.getElementById('sentrequest');

            var archivos =<?php echo json_encode($datarequest[0]->archivo);?>;
             for(var i=0;i<archivos.length;i++)
            {
             var file ={
                name: archivos[i].nombre+archivos[i].tipo,
                size: 1100,
                slug: archivos[i].slug
              }
              mydrop.options.addedfile.call(mydrop, file);
             //thisDropzone.options.thumbnail.call(thisDropzone, archivos, archivos.path);
             //mydrop.options.thumbnail.call(mydrop,  archivos[i]);
    
              }


           this.on('sending', function(file, xhr, formData){
            formData.append('_token', $('[name="_token"]').val());
             formData.append('slug', $('[name="slug"]').val());
             });

            this.on('success', function(file, xhr, formData){
                sentrequest.disabled = false; 
             });
       
          },


          removedfile: function(file) {
              sentrequest.disabled = false;
               
               var url= "{{route('deleteFilesM')}}",
                xdata= {
                  name: file.name, 
                  _token: $('[name="_token"]').val(), 
                  slug: $('[name="slug"]').val(),
                  slugFile: file.slug
                 };

             $.post(url, xdata).done(function( result ) { 
              console.log(result);
              if(result.indexOf("NOT OK")==-1){
                /**/
                }

              });

             var _ref;
              if (file.previewElement) {
                if ((_ref = file.previewElement) != null) {
                  _ref.parentNode.removeChild(file.previewElement);
                }
              }
              return this._updateMaxFilesReachedClass();

          }
        }
    </script>
@endsection