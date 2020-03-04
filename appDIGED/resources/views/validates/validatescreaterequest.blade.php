 @if(session('result'))
       @if(session('result')=="succes")
          <div class="alert alert-primary alert-dismissible fade show"  role="alert">
               ¡Solicitud creada con éxito! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>            
      
          @elseif(session('result')=="succesM")
          <div class="alert alert-primary alert-dismissible fade show"  role="alert">
               !Solcitud modificada con éxito!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>            
      
          @else
            
            <div class="alert alert-warning alert-dismissible fade show "  role="alert">
                   !Error al tratar de crear solicitud,vuelve a intentarlo!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
        
          @endif
              @endif