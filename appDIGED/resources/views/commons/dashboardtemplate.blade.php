@extends('commons.maintemplate')


@section('customs')
<link href="{{asset('Customs/css/dashboard.css')}}" type="text/css" rel="stylesheet">
</link>
@endsection

@section('content')

    <dir class="lds-spinner" id="spinner"><div></div></dir>
    <!-- Content here -->
    <header>
    <nav class="navbar navbar-expand-lg navbar-light   fixed-top">
        <a class="navbar-brand" href="/dashboard">
            <img alt="DIGED" id="iconn" src="/images/diged.png"/>
            DIGED
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @yield('indashboard')">
                    <a class="nav-link" href="\dashboard">
                        Dashboard
                    </a>
                </li>
                @if( auth()->user()->perfil !='U')
                <li class="nav-item @yield('inpersonalinf')">
                    <a class="nav-link" href="\personalinf">
                         Información personal 
                    </a>
                </li>
                @endif
                @if( auth()->user()->perfil =='U')
                <li class="nav-item @yield('increate')">
                    <a class="nav-link" href="\createR">
                        Crear solicitud
                    </a>
                </li>
                @elseif (auth()->user()->perfil =='R')
                <!--li class="nav-item @yield('inconfigure')">
                    <a class="nav-link" href="\configure">
                        Configuraciones
                    </a>
                </li>-->
                @endif
                <li class="nav-item @yield('inhistory')">
                    <a class="nav-link  " href="\history\">
                        Historial
                    </a>
                </li>
                @yield('inview')
            </ul>
            
            <form action="{{route('logout')}}" class="form-inline my-2 my-lg-0" method="POST">
                {{csrf_field()}}
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <h6 class="nav-link" >
                                   
                           <i class="fas fa-user-tie"></i> : {{auth()->user()->p_nombre?auth()->user()->p_nombre:'Usuario'}}
                         </h6>
                    </li>
                    <li class="nav-item">
                        <span class="d-inline-block"  data-toggle="tooltip" title="Logout">
                        <button class="btn  btn-outline-info my-2 my-sm-0" type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            
                        </button>
                        </span>
                        
                    </li>
                </ul>
            </form>
        </div>
    </nav>
 <header>
  <section>      
    @yield('contentDash')
   </section>
    @endsection
