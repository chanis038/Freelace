@extends('commons.maintemplate')

@section ('title', 'Login')

@section ('customs')

<link href="{{asset('Customs/css/login.css')}}" rel="stylesheet"></link>
    @endsection

@section('content')
    <!------ Include the above in your HEAD tag ---------->
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <!-- Icon -->
            <div class="fadeIn first">
                <img alt="User Icon" id="icon" src="images/diged.png"/>
                <h3>
                    Dirección General de Docencia
                </h3>
                <br>
                    <h6>
                        Gestión de solicitudes para ayuda económica 
                    </h6>
                <br>
            </div>
            <!-- Login Form -->
            <form action="{{ route ('login') }} " method="Post">
                {{csrf_field()}}
                <div class="form-group">
                    <input class="fadeIn second {{ $errors->has('registro')?'border border-danger':''}}" name="registro" placeholder="Número de registro" type="text" value="{{old('registro')}}"
                    pattern="[0-9]{1,15}" 
                    title="El campo solo permite numeros sin espacios"
                    >
                        <!-- optencion de error registro-->
                        {!!$errors->first('registro','
                        <br>
                            <span class="help-block">
                               <h6> :message </h6>
                            </span>
                            ')!!}
                        <br>
                    </input>
                </div>
                <div class="form-group">
                    <input class="fadeIn third {{ $errors->has('password')?'border border-danger':''}}" name="password" placeholder="Clave" type="password">
                        <!-- optencion de error password -->
                        {!!$errors->first('password','
                        <br>
                            <span class="help-block">
                               <h6> El campo clave es obligatorio </h6>
                            </span>
                            ')!!}
                        <br>
                    </input>
                </div>
                <input class="fadeIn fourth" type="submit" value="Ingresar ">
                </input>
            </form>
        </div>
    </div>
    @endsection

    @section('footer')
    <div class="container-fluid text-center text-md-left">
      <h5>Politicas de acceso</h5>
        <p>
            Al iniciar sesión acepta los términos de uso, política de privacidad y manejo de cookies,
            lea los términos de policitas de privasidad y manejo de cookies <a class="badge badge-light" href="https://virtual.usac.edu.gt/politica-de-privacidad-y-cookies/" target="_blank" > aquí</a>, lea los términos de uso de este sitio <a class="badge badge-light" href="https://virtual.usac.edu.gt/terminos-de-uso/" target="_blank" > aquí</a>.
        </p>
  </div>
   <hr class="clearfix w-100 d-md-none ">
    <div class="footer-copyright text-center py-3"><p>© 2020 Copyright: Diged USAC</p>
     </div>
    @endsection 
