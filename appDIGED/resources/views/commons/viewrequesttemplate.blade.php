@extends('commons.dashboardtemplate')

@section('title')
vista
@endsection

@section('contentDash')

<main class="container" id="dashmain" role="main">
   @include('validates.validatesRequest')
  
   <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
              Informacion de Solicitud  SAE-{{$data[0]->id}}
            </h6>
                    </div>
    </div>

     <div class="my-3 p-3 bg-white rounded shadow-sm">
           @php
           $request= $data[0];
           @endphp

        <div class="row">
         <div class=" col-xs-6 col-ms-6 col-md-4 ">
           <strong>Creado por: </strong> {{$request->p_nombre.' '.$request->p_apellido}}     
         </div>  
         <div class=" col-xs-6 col-ms-6 col-md-4 ">
           <strong>Unidad Académica: </strong> {{$request->unidad_academica}}     
         </div>
         <div class=" col-xs-6 col-ms-6 col-md-4 ">
           <strong>Fecha de Solicitud: </strong> {{$request->created_at}}  
        </div> 
                   
        </div>

        <div class="row">
        
        <div class=" col-xs-6 col-ms-6 col-md-4 ">
          <strong>Monto solicitado (Q): </strong> {{$request->monto}}  
         </div> 
         <div class=" col-xs-6 col-ms-6 col-md-4 ">
           <strong>Tipo: </strong>
            @include("validates/tiposolicitud")
           
         </div> 
           <div class=" col-xs-6 col-ms-6 col-md-4 ">
          <strong>Estado: </strong>
          @include("validates/estadosolicitud") 
       
         </div>                   
        </div>
          
        <div class="row">
       <div class=" col-xs-6 col-ms-6 col-md-8 ">
           <strong>Catedras que imparte: </strong> {{$request->catedras}}     
         </div>               
        </div>

        <div class="row justify-content-center" >
          @php  
            $txt="";
              switch ($request->estado) {
                case 'EN':
                    $txt="Aprobar Solicitud";
                  break;
                case 'AP':
                    $txt="Autorizar Solicitud";
                  break;
                  case 'AA':
                    $txt="Enviar a Tesoreria";
                  break;
                  case 'ET':
                    $txt="Listoa para recoger";
                  break;
                  case 'LT':
                    $txt="Entregado";
                  break;
                default:
                  $txt=""; 
                  break;
              }

           @endphp
          @if(auth()->user()->perfil == "R")

            @if($request->estado== "EN" || $request->estado== "AP" || $request->estado== "AA")
                <div class=" col-xs-2 col-ms-2 col-md-3 mb-1" >
                <button type="button" class="btn btn-outline-primary btn-sm" name="comment" id= 'comment'> Agregar observacion
                </button> 
                </div>

                <div class=" col-xs-2 col-ms-2 col-md-3 mb-1">
                <form method="post" action="{{route('changeState')}}" >
                  {{csrf_field()}}
                <input type="hidden" name="slug" value="{{$request->slug}}">
                <input type="hidden" name="estado" value="{{$request->estado}}">
                <button type="submmit" class="btn btn-outline-primary btn-sm" >{{$txt}} 
                </button> 
                </form>   
                </div> 

            @endif

            @if($request->estado== "EN" || $request->estado== "AP")
                <div class=" col-xs-2 col-ms-2 col-md-3 mb-1">
                <form method="post" action="{{route('changeState')}}">
                  {{csrf_field()}}
                <input type="hidden" name="slug" value="{{$request->slug}}">
                <input type="hidden" name="estado" value="NA">
                <button type="submmit" class="btn btn-outline-primary btn-sm">Rechazar Solicitud
                </button> 
                </form>   
              </div> 

            @endif
                         
             @if($request->estado== "AT")
               <div class=" col-xs-2 col-ms-2 col-md-3 mb-1">
               <a class="btn btn-outline-primary btn-sm" href="/viewdFileDeal/{{$request->slug}}">Crear Acuerdo</a>
              </div>
  
            @endif

          @elseif(auth()->user()->perfil == "D")

              @if($request->estado== "AP")
               <div class=" col-xs-3 col-ms-3 col-md-3 mb-1">
               <button type="button" class="btn btn-outline-primary btn-sm" name="comment" id= 'comment' >Agregar observacion
               </button>
              </div>
               <div class=" col-xs-3 col-ms-3 col-md-3 mb-1">
                <form method="post" action="{{route('changeState')}}">
                  {{csrf_field()}}
                <input type="hidden" name="slug" value="{{$request->slug}}">
                <input type="hidden" name="estado" value="{{$request->estado}}">
                <button type="submmit" class="btn btn-outline-primary btn-sm"> Autorizar Solicitud
                </button>
                </form>   
              </div> 
                <div class=" col-xs-3 col-ms-3 col-md-3 mb-1">
                <form method="post" action="{{route('changeState')}}">
                  {{csrf_field()}}
                <input type="hidden" name="slug" value="{{$request->slug}}">
                <input type="hidden" name="estado" value="NA">
                <button type="submmit" class="btn btn-outline-primary btn-sm"> Rechazar Solicitud
                </button>
                </form>   
              </div>
               @endif

           @elseif(auth()->user()->perfil == "T")
                @if($request->estado== "ET" || $request->estado== "LT")
                  <div class=" col-xs-3 col-ms-3 col-md-3 mb-1">
                  <form method="post" action="{{route('changeState')}}">
                    {{csrf_field()}}
                  <input type="hidden" name="slug" value="{{$request->slug}}">
                  <input type="hidden" name="estado" value="{{$request->estado}}">
                  <button type="submmit" class="btn btn-outline-primary btn-sm"> {{$txt}}
                  </button>
                  </form>   
                </div>
              
                @endif   
            @endif                         
        </div>
    </div>
     
   @yield('filescontent') 

   <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ol class="nav ">
        @foreach($data as $file)
         <li class="nav-item ">
           <a class="nav-link" href="\downloadFile\{{$file->slugA}}">
                        {{$file->nombre}}
                    </a>
          </li>
       
      @endforeach
      <li class="nav-item ">
           <a class="nav-link" href="\downloadFile\{{$request->slug}}\1">
                       Descargar todo
                    </a>
          </li>
       </ol>
    </div>
    @yield('link')

  </main>

  @endsection