<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
            @yield('title') | DIGED
        </title>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <link href="{{asset('Plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
                </link>
                <link href="{{asset('Customs/css/spinner.css')}}" rel="stylesheet">
                </link>
                 @yield('customs')
            </meta>
        </meta>
    </head>
    <body class="bg-light">
    <dir class="loader" id="spinner">loading...</dir>
        
        @yield('content')

    <footer>
        <hr class="mb-4" />

    </footer>
    </body >

        <script src="{{asset('Plugins/bootstrap/jquery/jquery.min.js')}}">
        </script>
        <script src="{{asset('Plugins/bootstrap/js/popper.min.js')}}">
        </script>
        <script src="{{asset('Plugins/bootstrap/js/bootstrap.min.js')}}">
        </script>
        <script src="{{asset('Plugins/fontawesome/03e2521f9b.js')}}">
        </script>
               
        @yield('scripts')

        <script type="text/javascript">
        window.onload = function () {
            var spinner = document.getElementById("spinner");
            spinner.style.visibility="hidden";
            spinner.style.opacity=0;
        }
        </script>
    
</html>