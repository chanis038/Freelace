@extends('commons.dashboardtemplate')

@section('title')
Dashboard
@endsection

@section('indashboard')
active
@endsection

@section('contentDash')

<main class="container" id="dashmain" role="main">
  @include('validates/validatesRequest')

	 <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
              Lista de solicitudes

            </h6>
                    </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Ultimas solicitudes</h6>
     
      @foreach($data as $request)
    <div class="media text-muted pt-3">
          <h8 class="mr-2 rounded"> SAE-{{$request->id}}</h8>
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">
              	      @include("validates/tiposolicitud")

              </strong>
              @if($request->estado =="EN" && auth()->user()->perfil=="U")
              <a class="badge badge-info" href="/viewModifyRequest/{{$request->slug}}">
              <span class="d-inline-block"  data-toggle="tooltip" title="Editar">
              <i class="fas fa-edit"> editar</i>  </span></a>

              @endif
                
                <a  class="badge badge-info" href="/viewRequest/{{$request->slug}}">
                <span class="d-inline-block"  data-toggle="tooltip" title="Ver Solicitud">
                <i class="fas fa-eye"> ver</i> 
                </span>
                </a>

            </div>
            <span class="d-block">Fecha de creación: {{ $request->created_at}}</span>
            <span class="d-block">Estado:
                       @include("validates/estadosolicitud")
                      </span>
                     </div>
                 </div>

  @endforeach	 

             
      </div>

 </main>
@endsection
@section('scripts')
<script type="text/javascript">
  (function(){
    function actualizar(){location.reload(true);}
  setInterval(actualizar,30000);
  })();
</script>
@endsection
