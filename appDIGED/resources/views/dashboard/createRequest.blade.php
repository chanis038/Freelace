@extends('commons.dashboardtemplate')

@section('title')
Crear
@endsection

@section('increate')
active
@endsection

@section('customs')
<link href="{{asset('Customs/css/dashboard.css')}}" type="text/css" rel="stylesheet">
<link href="{{asset('Plugins/dropzone/dist/min/dropzone.min.css')}}" type="text/css" rel="stylesheet" />

@endsection

@section('contentDash')

        <main role="main" class="container" id="dashmain">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
       
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Crear solicitud</h6>
          <small>Ingreso de información para la creación de solicitudes </small>
        </div>
      </div>

      <form name="Solicitud" method="POST"  action="{{ route ('saveRequest')}}" >
        {{csrf_field()}}
        <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">información  para la solicitud de ayuda económica </h6>
        <div class="row">
        <div>
          <input type="hidden" name="slug" value="{{$slug}}">
        </div>
      <div class=" col-xs-6 col-ms-6 col-md-4 mb-3">
                <label for="tipo">Tipo de solicitud</label>
                <select class="custom-select d-block w-100" name="tipo" id='tipo'>
                  <option value="PM">Pago de maestría</option>
                  <option value="PD">Pago de doctorado</option>
                  <option value="PB">Pago de boleto Aéreo</option>
                  <option value="PV">Pago de viáticos</option>
                  <option value="PBV">Pago de boleto aéreo y viaticos</option>
                </select>
                </div>
                </div>
                <div class="row">
                
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                <label for="monto">Monto (Q)</label>
                <input type="text" class="form-control" name="monto" placeholder="10 o 10.00" value="" maxlength=12 required
                pattern="[0-9]{2,20}([\.,][0-9]{2})?"
                title="El campo solo numeros enteros y decimal con 2 digitos" 
                ></div>

               <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                <label for="monto_letras">Monto en letras</label>
                <input type="text" class="form-control" name="monto_letras" placeholder="Diez quetzales exactos" value="" maxlength=191 required
                pattern="[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,60}"
                title="El campo solo permite letras" >
               </div>
           
        </div>
       <div class="row">
      
               <div class=" col-xs-6 col-ms-6 col-md-8 mb-3">
                <label for="justificacion">Justificación de la ayuda</label>
                <textarea   class="form-control" name="justificacion" placeholder=" " value="" maxlength=191></textarea>
               </div>
        </div>   


  </div>

      @include('commons.bodyrequest')
         <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit"  id= "sentrequest" name="sentrequest" disabled="true" >Enviar solicitud</button>
    </form>   
      
    </main>


@endsection

@section('scripts')
<script src="{{asset('Plugins/dropzone/dist/min/dropzone.min.js')}}">
        </script>

     <script type="text/javascript"> 
       var urlPostLoad= "{{route('loadFiles')}}",
          urlPostDelete= "{{route('deleteFilesM')}}";
          path="{{asset('/')}}",
           user= "{{auth()->user()->registro."$$".$slug}}";;  
    </script>
    <script src="{{asset('Customs/js/customDropzoneCreate.js')}}">
    </script>     
@endsection