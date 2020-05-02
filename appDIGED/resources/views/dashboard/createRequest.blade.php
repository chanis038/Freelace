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
        @include('validates/validatesRequest')
      <div class="p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
       
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Crear solicitud</h6>
          <small>Ingreso de información para la creación de solicitudes </small>
        </div>
         <a class="btn btn-sm  btn-primary mr-auto float-right" href="\personalinf">
                        Actualizar información personal 
                    </a>

      </div>

      <form name="Solicitud"  id = 'solicitud' method="POST"  action="{{ route ('saveRequest')}}" >
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
                  @if(auth()->user()->tipo_cargo != 'AD' && auth()->user()->tipo_cargo != 'CI')
                  <option value="PM">Pago de maestría</option>
                  <option value="PD">Pago de doctorado</option>
                  @endif
                  <option value="PCC">Pago de capacitación o curso </option>
                  <option value="PB">Pago de boleto Aéreo</option>
                  <option value="PV">Pago de viáticos</option>
                  <option value="PBV">Pago de boleto aéreo y viaticos</option>
                </select>
                <a style="font-size: 13px; text-decoration: underline;" href="/media/Ayuda-becaria-economica.pdf" target="_blank" > Leer más sobre ayudas becarias y economías</a>
                </div>
            </div>
           <div id='datos' name='datos'>
             <!---contenido dinamico --->

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

    @include('commons.ErrorMessage')
      <hr class="mb-4">
    </main>


@endsection

@section('scripts')
<script src="{{asset('Plugins/dropzone/dist/min/dropzone.min.js')}}">
        </script>
          <script src="{{asset('Plugins/momentjs/momentjs.js')}}">
        </script>

     <script type="text/javascript"> 
       var urlPostLoad= "{{route('loadFiles')}}",
          urlPostDelete= "{{route('deleteFilesM')}}",
          path="{{asset('/')}}",
           user= "{{auth()->user()->registro."$$".$slug}}",
           data =[],
           fill = false;


    </script>
     <script src="{{asset('Customs/js/customDatos.js')}}">
    </script> 

    <script src="{{asset('Customs/js/customDropzoneCreate.js')}}">
    </script>     
@endsection