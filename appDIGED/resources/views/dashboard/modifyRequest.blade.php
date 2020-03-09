@extends('commons.dashboardtemplate')

@section('title')
Modificar
@endsection

@section('customs')
<link href="{{asset('Customs/css/dashboard.css')}}" type="text/css" rel="stylesheet">
<link href="{{asset('Plugins/dropzone/dist/min/dropzone.min.css')}}" type="text/css" rel="stylesheet" />

@endsection

@section('contentDash')

        <main role="main" class="container" id="dashmain">
        @include('validates/validatespersonalinf')
      <div class=" p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
       
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Modificar solicitud SAE-{{$datarequest[0]->id}}</h6>
          <small>Ingreso de información para la modificación de solicitud </small>

        </div>
       <a class="btn btn-sm  btn-primary mr-auto float-right" href="\personalinf\{{$datarequest[0]->slug}}">
                        Actualizar información personal 
                    </a>
               


      </div>

       
      <form name="Solicitud" id = 'solicitud' method="POST"  action="{{ route ('modifyRequest')}}" >
        {{csrf_field()}}
        <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Información  para la solicitud de ayuda económica </h6>
        <div class="row">
        <div>
        <input type="hidden" name="slug" value="{{ $datarequest[0]->slug }}">
        </div>
      <div class=" col-xs-6 col-ms-6 col-md-4 mb-3">
                <label for="tipo">Tipo de solicitud</label>

                <select class="custom-select d-block w-100" name="tipo" id='tipo' value='PD'>
                  @if(auth()->user()->tipo_cargo != 'AD' && auth()->user()->tipo_cargo != 'CI')
                  <option value="PM"{{$datarequest[0]->tipo=="PM"?'Selected':''}}>Pago de maestría</option>
                  <option value="PD" {{$datarequest[0]->tipo=="PD"?'Selected':''}}>Pago de doctorado</option>
                  @endif
                  <option value="PCC" {{$datarequest[0]->tipo=="PCC"?'Selected':''}} >Pago de capacitación o curso </option>
                  <option value="PB" {{$datarequest[0]->tipo=="PB"?'Selected':''}}>Pago de boleto aéreo</option>
                  <option value="PV" {{$datarequest[0]->tipo=="PV"?'Selected':''}}>Pago de viáticos</option>
                  <option value="PBV" {{$datarequest[0]->tipo=="PBV"?'Selected':''}}>Pago de boleto aéreo y viaticos</option>
                </select>
                </div>
                </div>
               
                <div id='datos' name='datos'>
                <!---contenido dinamico --->

                </div> 
       <div class="row">
      
               <div class=" col-xs-6 col-ms-6 col-md-8 mb-3">
                <label for="justificacion">Justificación de la ayuda</label>
                <textarea   class="form-control" name="justificacion"  maxlength=191>{{$datarequest[0]->justificacion}}</textarea>
               </div>
        </div>   


  </div>

      @include('commons.bodyrequest')
         <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit"  id= "sentrequest" name="sentrequest" >Guardar cambios</button>
    </form>   
      
    </main>
    @include('validates.datosTipoSolicitud');

    @php
  $data;
  switch ($datarequest[0]->tipo) {
    case 'PM':
      $data = array('duracion' =>$datarequest[0]->duracion,
            'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
            'frecuencia_pago' => $datarequest[0]->frecuencia_pago,
            'costo_parcial' => $datarequest[0]->costo_parcial);

      break;

    case 'PD':
      # code...
      $data = array('duracion' =>$datarequest[0]->duracion,
            'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
            'frecuencia_pago' => $datarequest[0]->frecuencia_pago,
            'costo_parcial' => $datarequest[0]->costo_parcial);

      break;

    case 'PV':
      $data = array('duracion' =>$datarequest[0]->duracion,
            'fecha_viaje' => $datarequest[0]->fecha_viaje,
            'tipo_duracion' => $datarequest[0]->tipo_duracion,
            'lugar' => $datarequest[0]->lugar);
      
      break;

    case 'PB':
      $data = array('duracion'=>$datarequest[0]->duracion,
            'fecha_viaje' => $datarequest[0]->fecha_viaje,
            'tipo_duracion' => $datarequest[0]->tipo_duracion,
            'lugar' => $datarequest[0]->lugar);
      
      break;

    case 'PBV':
      # code...
      $data = array('duracion'=>$datarequest[0]->duracion,
            'fecha_viaje' => $datarequest[0]->fecha_viaje,
            'tipo_duracion' => $datarequest[0]->tipo_duracion,
            'lugar' => $datarequest[0]->lugar);
      
      break;
    case 'PCC':
      # code...
      $data = array('duracion'=>$datarequest[0]->duracion,
            'tipo_duracion' => $datarequest[0]->frecuencia_pago,
            'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
            'costo_parcial' => $datarequest[0]->costo_parcial);
      
      break;
    
    default:
      # code...
    $data = array();

      break;
  }

@endphp

@endsection

@section('scripts')
<script src="{{asset('Plugins/dropzone/dist/min/dropzone.min.js')}}">
        </script>
        <script src="{{asset('Plugins/momentjs/momentjs.js')}}">
        </script>

    
     <script type="text/javascript"> 
      var urlPostLoad= "{{route('loadFiles')}}",
          urlPostDelete= "{{route('deleteFilesM')}}",
          loadArchivos=<?php echo json_encode($datarequest[0]->archivo);?>,
          path= "{{asset('/')}}",
          user= "{{auth()->user()->registro."$$".$datarequest[0]->slug}}",
          datafill =<?php echo json_encode($data);?>,
          fill = true;

    </script>
    
     <script src="{{asset('Customs/js/customDatos.js')}}">
    </script> 
    
    <script src="{{asset('Customs/js/customDropzoneModify.js')}}">
    </script>  

   @endsection