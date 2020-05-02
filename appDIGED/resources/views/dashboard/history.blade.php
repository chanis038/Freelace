@extends('commons.dashboardtemplate')

@section('title')
Historial
@endsection

@section('inhistory')
active
@endsection

@section('contentDash')

<main class="container mt-3" id="dashmain" >
	<form action="{{route('history')}}" method="GET">
		{{csrf_field()}}
	<div class="input-group input-group-sm mb-4 ">

	@if(auth()->user()->perfil !="U")
  	 <input type="text" class="form-control mr-sm-2 rounded"  placeholder="Registro" name="registro" pattern="[0-9]{6,11}" title="El campo solo permite numeros, sin espacios,con minimo 6 digitos y maximo 11" >
  	 <input type="text" class="form-control mr-sm-2 rounded"  placeholder="nombre" name="nombre" pattern="[a-zA-ZáíóöúüñÁÉÍÓÚÜÑ]{2,60}" title="El campo solo permite letras " >
  	@endif
  	 <input type="number" class="form-control mr-sm-2 rounded"  placeholder="Mes" max="12" name='mes'>
  	 <input type="number" class="form-control mr-sm-2 rounded"  placeholder="Año"  min="2010" name="anio">
  	 <span class="d-inline-block"  data-toggle="tooltip" title="Buscar">
  	 <button type="summit" class="btn btn-primary fas fa-search"> </button>
  	</span>
	</div>
	</form>

	<table class="table table-sm ">
  	<thead  >
    <tr  class="my-3 p-3 text-white-50 bg-purple shadow-sm rounded ">
      <th  scope="col">Id</th>
      <th scope="col">Solicitante</th>
      <th scope="col">Que solicita</th>
      <th scope="col">Estado</th>
      @if($data)
      @if(auth()->user()->perfil!="U")
       <th scope="col">Observación</th>
      @endif
      @endif

      <th scope="col">Ver</th>
    </tr>
  </thead>

  <tbody>

      @if($data)
    @foreach($data as $request)
 	<tr>
	<th scope="row">SAE-{{$request->id}}</th>
      <td>
      	 <div class="media-body pb-3 mb-0 small  border-gray">
        <span class="d-block">Número de registro: {{$request->registro}}</span>    
        <span class="d-block">Nombre: {{$request->p_nombre.' '.$request->p_apellido}}</span>
        <span class="d-block">Unidad académica: {{$request->unidad_academica}}</span>
        <span class="d-block">Titularidad: {{$request->titularidad}}</span>
                         
           </div>
      </td>
      <td>
      	 <div class="media-body pb-3 mb-0 small   border-gray">
	    <span class="d-block">Justificación: {{$request->justificacion}}</span>    
	    <span class="d-block">Monto: {{$request->monto}}</span></td>
      </div>
      <td>
      	 <div class="media-body pb-3 mb-0 small  border-gray">
      @include("validates/estadosolicitud")
  </div>
  	</td>
 	@if(auth()->user()->perfil!="U")
  	<td>
      	 <div class="media-body pb-3 mb-0 small  border-gray">
      <span class="d-block">{{$request->observacion}}</span>
  </div>
  	</td>
  	@endif
      <td>
  			 @if($request->estado =="EN" && auth()->user()->perfil=="U")
              <a class="badge badge-info" href="/viewModifyRequest/{{$request->slug}}">
              <span class="d-inline-block"  data-toggle="tooltip" title="Editar">
              <i class="fas fa-edit"></i> </span></a>

              @endif
                
                <a  class="badge badge-info" href="/viewRequest/{{$request->slug}}">
                <span class="d-inline-block"  data-toggle="tooltip" title="Ver Solicitud">
                <i class="fas fa-eye"></i>
                </span>
                </a>

               
      </td>
    </tr>
    @endforeach	
  </tbody>
    @endif
</table>
   @if($data)
   	{{$data->render()}}
   	@endif


</main>

@endsection