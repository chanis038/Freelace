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
                    Direcciòn General de Docencia
                </h3>
                <br>
                    <h6>
                        Gestion de solicitudes para ayuda economica
                    </h6>
                </br>
            </div>
            <!-- Login Form -->
            <form action="{{ route ('login') }} " method="Post">
                {{csrf_field()}}
                <div class="form-group ">
                    <input class="fadeIn second {{ $errors->has('registro')?'border border-danger':''}}" name="registro" placeholder="Numero de registro" type="text" value="{{old('registro')}}">
                        <!-- optencion de error registro-->
                        {!!$errors->first('registro','
                        <br>
                            <span class="help-block">
                               <h6> :message </h6>
                            </span>
                            ')!!}
                        </br>
                    </input>
                </div>
                <div class="form-group">
                    <input class="fadeIn third {{ $errors->has('password')?'border border-danger':''}}" name="password" placeholder="password" type="password">
                        <!-- optencion de error password -->
                        {!!$errors->first('password','
                        <br>
                            <span class="help-block">
                               <h6> :message </h6>
                            </span>
                            ')!!}
                        </br>
                    </input>
                </div>
                <input class="fadeIn fourth" type="submit" value="Ingresar">
                </input>
            </form>
        </div>
    </div>
    @endsection
