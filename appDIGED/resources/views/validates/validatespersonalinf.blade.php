 @if(session('response'))
      @if(session('response')=="1")
      
          <div class="alert alert-primary alert-dismissible fade show mt-2"  role="alert">
               Datos actualizados correctamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>     
                   
      
          @elseif(session('response')=="2")
             <div class="alert alert-warning alert-dismissible fade show mt-2"  role="alert">
               Tiene que llenar estos campos para poder crear una solicitud:{{session('txt')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             </div> 

          @else
            
            <div class="alert alert-warning alert-dismissible fade show show mt-2" id="dashmain" role="alert">
                   !Error, no se pudieron actualizar los datos!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                 
        
          @endif
              @endif