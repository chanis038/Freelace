@extends('commons.dashboardtemplate')

@section('title')
    Informacion
@endsection

@section('inpersonalinf')
active
@endsection


@section('contentDash')
<main class="container" id="dashmain" role="main">
      
    @include('validates/validatespersonalinf')
    

    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
                Informacion Personal

            </h6>
            <small>
                Esta informacion se usa para la creacion de solicitedes
            </small>
        </div>
    </div>
    <form action="{{ route ('updateinf')}}" method="POST" name="Solicitud">
        {{csrf_field()}}
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                Informacion Personal
            </h6>
            <div class="row">
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="p_nombre">
                        Primer Nombre
                    </label>
                    <input  class="form-control" maxlength="191" name="p_nombre" placeholder="" required="" type="text" value="{{$errors->any()?old('p_nombre'):auth()->user()->p_nombre}}"  
                                >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="s_nombre">
                        Segundo Nombre
                    </label>
                    <input  class="form-control" maxlength="191" name="s_nombre" placeholder=" opcional" type="text" value="{{ $errors->any()?old('s_nombre'):auth()->user()->s_nombre}}"  
                >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="p_apellido">
                        Primer Apellido
                    </label>
                    <input  class="form-control" maxlength="191" name="p_apellido" placeholder="" required="" type="text" value="{{ $errors->any()?old('p_apellido'):auth()->user()->p_apellido}}"  
              >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="s_apellido">
                        Segun Apellido
                    </label>
                    <input  class="form-control" maxlength="191" name="s_apellido" placeholder="opcional" type="text" value="{{$errors->any()?old('s_apellido'):auth()->user()->s_apellido}}"
                  >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="nacionalidad">
                        Nacionalidad
                    </label>
                    <input  class="form-control" maxlength="191" name="nacionalidad" placeholder="" required="" type="text" value="{{$errors->any()?old('nacionalidad'):auth()->user()->nacionalidad}}"
                >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="dpi">
                        Numero de DPI
                    </label>
                    <input class="form-control" name="dpi" placeholder="" required="" type="text" maxlength="13" value="{{$errors->any()?old('dpi'):auth()->user()->dpi}}" >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="municipio">
                        Lugar de extension de DPI
                    </label>
                    <input class="form-control" maxlength="191" name="municipio" placeholder="municipio" required="" type="text" value="{{$errors->any()?old('municipio'):auth()->user()->municipio}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-2 mb-3">
                    <label for="edad">
                        Edad
                    </label>
                    <input class="form-control" maxlength="3" max="150" min="18" name="edad" placeholder="" required="" type="number" value="{{$errors->any()?old('edad'):auth()->user()->edad}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="profesion">
                        Profesion
                    </label>
                    <input class="form-control" maxlength="191" name="profesion" placeholder="" type="text" value="{{$errors->any()?old('profesion'):auth()->user()->profesion}}" >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="estdo_civil">
                        Estado Civil
                    </label>
                    <input class="form-control" maxlength="191" name="estdo_civil" placeholder="" required="" type="text" value="{{$errors->any()?old('estdo_civil'):auth()->user()->estdo_civil}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="direccion">
                        Direccion de Residencia
                    </label>
                    <input class="form-control" maxlength="191" name="direccion" equired="" type="text" value="{{$errors->any()?old('direccion'):auth()->user()->direccion}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="correo">
                        Correo Electronico
                    </label>
                    <input class="form-control" maxlength="191" name="correo" required="" type="email" value="{{$errors->any()?old('correo'):auth()->user()->correo}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="nit">
                        Numero de NIT
                    </label>
                    <input class="form-control" maxlength="13" name="nit" placeholder="" type="text" value="{{$errors->any()?old('nit'):auth()->user()->nit}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="n_telefono">
                        Numero de Telefono
                    </label>
                    <input class="form-control" maxlength="15" name="n_telefono" placeholder="" type="text" value="{{$errors->any()?old('n_telefono'):auth()->user()->n_telefono}}">
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="n_celular">
                        Numero de Celular
                    </label>
                    <input class="form-control" maxlength="15" name="n_celular" placeholder="" type="text" value="{{$errors->any()?old('n_celular'):auth()->user()->n_celular}}">
                    </input>
                </div>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                Informacion De Docencia
            </h6>
            <div class="row">
                <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="registro">
                        Numero de Registro: 
                    </label>
                    <label class="form-control" >
                    {{auth()->user()->registro}}
                    </label>
                </div>
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="n_carne">
                        Numero de Carne:
                    </label>
                    <input class="form-control" maxlength="11" name="n_carne" placeholder="" required type="text" value="{{$errors->any()?old('n_carne'):auth()->user()->n_carne}}" >
                    </input>

                </div>
                 <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="titularidad">
                        Titularidad:
                    </label>
                    <input class="form-control" maxlength="191" name="titularidad" placeholder="" required type="text" value="{{$errors->any()?old('titularidad'):auth()->user()->titularidad}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="unidad_academica">
                        Unidad Academica:
                    </label>
                    <input class="form-control" maxlength="191" name="unidad_academica" placeholder="" required  type="text" value="{{$errors->any()?old('unidad_academica'):auth()->user()->unidad_academica}}">
                    </input>
                </div>
                <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="departamento">
                        Departamento:
                    </label>
                    <input class="form-control" maxlength="191" name="departamento" placeholder="" required="" type="text" value="{{$errors->any()?old('departamento'):auth()->user()->departamento}}" >
                    </input>
                </div>
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="cargo">
                        Cargo que Ocupa:
                    </label>
                    <input class="form-control" maxlength="191" name="cargo" placeholder="" required="" type="text" value="{{$errors->any()?old('cargo'):auth()->user()->cargo}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-ms-8 col-md-8 mb-1">
                    <label for="catedras">
                            Catedra(s) que Imparte:
                    </label>
                    <input class="form-control" maxlength="191" name="catedras" placeholder=" Matematicas, Fisica, derecho penal...." required  type="text" value="{{$errors->any()?old('catedras'):auth()->user()->catedras}}">
                    </input>
                </div>
               
              
            </div>
        </div>
        <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
                Actualizar Datos
            </button>
        </hr>
    </form>
</main>
@endsection
