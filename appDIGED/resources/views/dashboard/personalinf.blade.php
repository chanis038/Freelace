@extends('commons.dashboardtemplate')

@section('title')
    Informacion
@endsection

@section('inpersonalinf')
active
@endsection


@section('contentDash')
<main class="container" id="dashmain" role="main">
        

    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
                Información personal
            </h6>
            <small>
                Esta información se usa para la creación de solicitudes 
            </small>
        </div>
    </div>
    <form action="{{ route ('updateinf')}}" method="POST" name="Solicitud">
        {{csrf_field()}}
        <div>
        <input type="hidden" name="slug" value="{{ $slug }}">
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                Información personal
            </h6>
            <div class="row">
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="p_nombre">
                        Primer nombre
                    </label>
                    <input  class="form-control" maxlength="60" name="p_nombre" placeholder=""  type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ]{2,60}" title="El campo solo permite letras" 
                    value="{{$errors->any()?old('p_nombre'):auth()->user()->p_nombre}}"  
                                >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="s_nombre">
                        Segundo nombre
                    </label>
                    <input  class="form-control" maxlength="60" name="s_nombre" placeholder="opcional" type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}" title="El campo solo permite letras " value="{{ $errors->any()?old('s_nombre'):auth()->user()->s_nombre}}"  
                >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="p_apellido">
                        Primer apellido
                    </label>
                    <input  class="form-control" maxlength="60" name="p_apellido" placeholder="" type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}"  title="El campo solo permite letras " 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{ $errors->any()?old('p_apellido'):auth()->user()->p_apellido}}"  
              >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="s_apellido">
                        Segundo apellido
                    </label>
                    <input  class="form-control" maxlength="60" name="s_apellido" placeholder="opcional" type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}" title="El campo solo permite letras "
                    value="{{$errors->any()?old('s_apellido'):auth()->user()->s_apellido}}"
                  >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="nacionalidad">
                        Nacionalidad
                    </label>
                    <input  class="form-control" maxlength="50" name="nacionalidad" placeholder=""   type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ]{2,50}"
                    title="El campo solo permite letras " 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('nacionalidad'):auth()->user()->nacionalidad}}"
                >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="dpi">
                        Número de DPI 
                    </label>
                    <input class="form-control" name="dpi" placeholder=""  type="text" maxlength="15" pattern="[0-9]{11,15}" 
                    title="El campo solo permite numeros sin espacios,con 11 digitos minimos"{{auth()->user()->perfil=="U"?'required':''}}  
                     value="{{$errors->any()?old('dpi'):auth()->user()->dpi}}" >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-4 col-md-3 mb-3">
                    <label for="municipio">
                        Lugar de extensión de DPI
                    </label>
                    <input class="form-control" maxlength="50" name="municipio" placeholder="municipio"  type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,50}" title="El campo solo permite letras " 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('municipio'):auth()->user()->municipio}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-4 col-md-2 mb-3">
                    <label for="edad">
                        Edad
                    </label>
                    <input class="form-control" maxlength="3" max="120" min="18" name="edad" placeholder=""  type="number" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('edad'):auth()->user()->edad}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="profesion">
                        Profesión 
                    </label>
                    <input class="form-control" maxlength="60" name="profesion" placeholder="" type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}" title="El campo solo permite letras " 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('profesion'):auth()->user()->profesion}}" >
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="estdo_civil">
                        Estado civil
                    </label>
                    <input class="form-control" maxlength="50" name="estdo_civil" placeholder="" type="text" pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ]{2,48}" title="El campo solo permite letras, sin espacios. " 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('estdo_civil'):auth()->user()->estdo_civil}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="direccion">
                        Dirección de residencia
                    </label>
                    <input class="form-control" maxlength="80" name="direccion"  type="text" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('direccion'):auth()->user()->direccion}}">
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="correo">
                        Correo electrónico 
                    </label>
                    <input class="form-control" maxlength="80" name="correo"  type="email" 
                    required
                    value="{{$errors->any()?old('correo'):auth()->user()->correo}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="nit">
                        Número de NIT 
                    </label>
                    <input class="form-control" maxlength="13" name="nit" placeholder="" type="text"  pattern="[0-9-]{6,13}" title="El campo solo permite numeros y guion, sin espacios" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('nit'):auth()->user()->nit}}" >
                    </input>
                </div>
                <div class="col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="n_telefono">
                        Número de Teléfono
                    </label>
                    <input class="form-control" maxlength="15" name="n_telefono" placeholder="" type="tel"  pattern="[0-9]{8,15}" title="El campo solo permite numeros, sin espacios" 
                    value="{{$errors->any()?old('n_telefono'):auth()->user()->n_telefono}}">
                    </input>
                </div>
                <div class=" col-xs-3 col-ms-6 col-md-3 mb-3">
                    <label for="n_celular">
                        Número de celular
                    </label>
                    <input class="form-control" maxlength="15" name="n_celular" placeholder="" type="tel"  pattern="[0-9]{8,15}" title="El campo solo permite numeros, sin espacios" 
                    value="{{$errors->any()?old('n_celular'):auth()->user()->n_celular}}">
                    </input>
                </div>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                Información de docencia
            </h6>
            <div class="row">
                <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="registro">
                        Número de registro
                    </label>
                    <label class="form-control" >
                    {{auth()->user()->registro}}
                    </label>
                </div>
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="n_carne">
                        Número de carné
                    </label>
                    <input class="form-control" maxlength="11" name="n_carne" placeholder=""  type="text"  pattern="[0-9]{7,11}" title="El campo solo permite numeros, sin espacios" 
                    value="{{$errors->any()?old('n_carne'):auth()->user()->n_carne}}" >
                    </input>
                </div>

                <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="unidad_academica">
                        Unidad académica
                    </label>
                    <input class="form-control" maxlength="80" name="unidad_academica" placeholder=""    pattern="[0-9a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,80}" title="El campo solo permite letras y numeros" type="text" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('unidad_academica'):auth()->user()->unidad_academica}}">
                    </input>
                </div>

                 <div class="col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="departamento">
                        Departamento
                    </label>
                    <input class="form-control" maxlength="60" name="departamento" placeholder=""  type="text"  pattern="[0-9a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}" title="El campo solo permite letras y numeros" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('departamento'):auth()->user()->departamento}}" >
                    </input>
                </div>

            </div>
            <div class="row">
                <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                <label for="tipo_cargo">Tipo de cargo</label>
                <select class="custom-select d-block w-100" name="tipo_cargo" id='tipo_cargo' value='PD'>
                  <option value="CT"{{auth()->user()->tipo_cargo=="CT"?'Selected':''}}>Catedrático titular</option>
                  <option value="CI" {{auth()->user()->tipo_cargo=="CI"?'Selected':''}}>Catedrático interino</option>
                  <option value="AD" {{auth()->user()->tipo_cargo=="AD"?'Selected':''}}>Administrativo</option>
                  </select>
                </div>

                 <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="cargo">
                        Cargo que ocupa:
                    </label>
                    <input class="form-control" maxlength="60" name="cargo" placeholder="" type="text"  pattern="[0-9a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\s]{2,60}" title="El campo solo permite letras y numeros" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('cargo'):auth()->user()->cargo}}" >
                    </input>
                </div>

                  <div class=" col-xs-6 col-ms-6 col-md-3 mb-3">
                    <label for="titularidad">
                        Titularidad
                    </label>
                    <input class="form-control" maxlength="50" name="titularidad" placeholder=""  type="text"  pattern="[a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ]{2,50}" title="El campo solo permite letras, sin espacios" 
                    value="{{$errors->any()?old('titularidad'):auth()->user()->titularidad}}" >
                    </input>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-ms-8 col-md-8 mb-1">
                    <label for="catedras">
                            Cátedra(s) que imparte:
                    </label>
                    <input class="form-control" maxlength="100" name="catedras" placeholder=" Matematicas, Fisica, derecho penal...."   pattern="[0-9a-zA-ZáéíóöúüñÁÉÍÓÚÜÑ\-,\s]{2,100}" title="El campo solo permite letras, numeros, guion, coma" type="text" 
                    {{auth()->user()->perfil=="U"?'required':''}}
                    value="{{$errors->any()?old('catedras'):auth()->user()->catedras}}">
                    </input>
                </div>
               
              
            </div>
        </div>
        <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
               Actualizar datos
            </button>
        </hr>
    </form>
</main>
@endsection
