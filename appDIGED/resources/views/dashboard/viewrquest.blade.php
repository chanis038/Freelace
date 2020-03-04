@extends('commons.viewrequesttemplate')

<script type="">

function redireccionar(){
 window.location="/viewRequestM/{{$data[0]->slug}}";
}

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   
	redireccionar();
}
</script>


@section('filescontent')

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
  	<object data="{{'/Solicitudes/'.$file->ruta.$file->nombre.$file->tipoA}}" type="application/pdf">
        <embed src="{{'/Solicitudes/'.$file->ruta.$file->nombre.$file->tipoA}}"
          />
    </object>
    @else
       
      <object data="{{'/Solicitudes/'.$file->ruta.$file->nombre.$file->tipoA}}" type="application/image">
        <embed class="img-fluid" max-width="100%" height="auto" src="{{'/Solicitudes/'.$file->ruta.$file->nombre.$file->tipoA}}"
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
</div>

@endsection

@section('link')
    <a class="list-group-item-warning " href="/viewRequestM/{{$data[0]->slug}}">
                      ¡Clic aquí, si no puede ver los archivos! 
                    </a>
@endsection