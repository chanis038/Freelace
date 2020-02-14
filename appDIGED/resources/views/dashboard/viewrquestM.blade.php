@extends('commons.dashboardtemplate')

@section('title')
vista
@endsection


@section('contentDash')

<main class="container" id="dashmain" role="main">
  
   <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">
              Informacion de Solicitud
            </h6>
                    </div>
    </div>

     <div class="my-3 p-3 bg-white rounded shadow-sm">
       
        <div class="row">
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
          <h6> Creado por: {{$data[0]->p_nombre.' '.$data[0]->p_apellido}}   </h6>  
         </div> 
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
          <h6> Tipo de Solicitud: {{$data[0]->tipo}}</h6> 
         </div> 
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
          <h6> Fecha de Solicitud: {{$data[0]->created_at}} </h6> 
         </div> 
          
        </div>
        <div class="row">
        <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
         <h6> Monto solicitado (Q): {{$data[0]->monto}} </h6> 
         </div> 
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
          <h6> Estado: {{$data[0]->estado}} </h6> 
         </div> 
         <div class=" col-xs-6 col-ms-6 col-md-4 mb-1">
          <h6> Estado: {{$data[0]->estado}} </h6> 
         </div> 
                
                   
        </div>
      
    </div>
     
    
<div class="my-3 p-3 bg-white rounded shadow-sm">

<div>
  <div class="align-items-center">
  <button class="btn btn-info btn-sm" id="prev">Anterior</button>
  <button class="btn btn-info btn-sm" id="next" >Siguente</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
   </div> 
</div>
   <hr class="mb-4" />
<canvas class="embed-responsive embed-responsive-16by9" id="the-canvas"></canvas>

 </div>


<div class="my-3 p-3 bg-white rounded shadow-sm">
        <ol class="nav ">
        @foreach($data as $file)
         <li class="nav-item ">
           <a class="nav-link" href="\downloadFile\{{$file->slugA}}">
                        {{$file->nombre}}
                    </a>
          </li>
       
      @endforeach
      <li class="nav-item ">
           <a class="nav-link" href="\downloadFile\{{$data[0]->slug}}\1">
                       Descargar todo
                    </a>
          </li>
       </ol>
    </div>
   

 
  
  </main>

@section('scripts') 
<style type="text/css">
  #the-canvas {
  border: 1px solid black;
  direction: ltr;
}

</style>

<script src="{{asset('Plugins/pdfjs/build/pdf.js')}}">
</script>

<script type="text/javascript">

 var url ="{{asset('/Solicitudes/'.$data[0]->formato.'SAE_'.$data[0]->id.'.pdf')}}";
// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = "{{asset('Plugins/pdfjs/build/pdf.worker.js')}}";

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});


</script>

@endsection

  @endsection