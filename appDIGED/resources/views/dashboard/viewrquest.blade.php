@extends('commons.dashboardtemplate')

@section('title')
vista
@endsection

<script type="">

function redireccionar(){
 window.location="/viewRequestM/{{$data[0]->slug}}";
}

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   
	redireccionar();
}
</script>


@section('contentDash')

<main class="container" id="dashmain" role="main">
  
	 <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
              Informacion de Solicitud
            </h6>
                    </div>
    </div>

     <div class="my-3 p-3 bg-white rounded shadow-sm">
       
        <div class="row">
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         	<h6> Creado por: {{$data[0]->p_nombre.' '.$data[0]->p_apellido}}   </h6>	
         </div>	
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         	<h6> Tipo de Solicitud: {{$data[0]->tipo}}</h6>	
         </div>	
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         	<h6> Fecha de Solicitud: {{$data[0]->created_at}} </h6>	
         </div>	
          
        </div>
        <div class="row">
        <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         <h6> Monto solicitado (Q): {{$data[0]->monto}} </h6>	
         </div>	
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         	<h6> Estado: {{$data[0]->estado}} </h6>	
         </div>	
                   
        </div>
      
    </div>

 	<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel"  data-interval="false">
  <div class="carousel-inner">

  	 @foreach($data as $file)
  	 @if ($loop->first)
     <div class="carousel-item active">
     @else
     <div class="carousel-item ">
     @endif
    <div class="embed-responsive embed-responsive-16by9 bg-dark" >
     
      @if ($file->tipoA ==".pdf")
  	<object data="{{'/Solicitudes/'.$file->formato.$file->nombre.$file->tipoA}}" type="application/pdf">
        <embed src="{{'/Solicitudes/'.$file->formato.$file->nombre.$file->tipoA}}"
          />
    </object>
    @else
       
      <object data="{{'/Solicitudes/'.$file->formato.$file->nombre.$file->tipoA}}" type="application/image">
        <embed class="img-fluid" max-width="100%" height="auto" src="{{'/Solicitudes/'.$file->formato.$file->nombre.$file->tipoA}}"
          />
    </object>
         
    @endif
	</div>


	</div>

	@endforeach
    
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>

</div>

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
           <a class="nav-link" href="\downloadFile\{{$data[0]->slug}}\1">
                       Descargar todo
                    </a>
          </li>
    	 </ol>
		</div>
</div>
 
  
	</main>


	@endsection