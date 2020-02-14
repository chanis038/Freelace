 @if(session('response'))
      @if(session('response')==1)
          <div class="alert alert-primary alert-dismissible fade show"  role="alert">
               Datos actualizados correctamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>            
      
          @else
            
            <div class="alert alert-warning alert-dismissible fade show " id="dashmain" role="alert">
                   Error .. no se pudieron actualizar los datos.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
        
          @endif
              @endif