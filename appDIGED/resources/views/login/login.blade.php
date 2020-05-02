@extends('commons.maintemplate')

@section ('title', 'Login')

@section ('customs')

<link href="{{asset('Customs/css/login.css')}}" rel="stylesheet"></link>
    @endsection

@section('content')

    <div class="wrapper fadeInDown">
        <div id="formContent">

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
                    required 
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
                    <input class="fadeIn third {{ $errors->has('password')?'border border-danger':''}}" name="password" placeholder="Clave" type="password" required >
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
                <div class="form-group" style="padding: 10px;"> 
					<div class="alert alert-info" role="alert">
						Al iniciar sesión usted acepta los términos de uso, política de privacidad y cookies.
					</div>
				</div>
            
        </div>

    </div>
    @endsection

    @section('footer')
    <hr class="clearfix w-50 d-md-none" />
        <div class=" footer-copyright text-center py-3 ">
            <p >
                <a class="badge badge-light"  href="https://virtual.usac.edu.gt/politica-de-privacidad-y-cookies/" target="_blank" > Política de privacidad y cookies</a> | 
                <a class="badge badge-light"  href="https://virtual.usac.edu.gt/terminos-de-uso/" target="_blank" >Términos de uso</a> | 
                Derechos Reservados, 2020 © Dirección General de Docencia USAC
            </p>
        </div>
    @endsection