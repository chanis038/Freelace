 @if(session('response'))
      @if(session('response')=="1")
      
          <div class="alert alert-primary alert-dismissible fade show mt-2"  role="alert">
               {{session('result')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>  
          @else
            
            <div class="alert alert-warning alert-dismissible fade show show mt-2" id="dashmain" role="alert">
                  {{session('result')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endif
              @endif