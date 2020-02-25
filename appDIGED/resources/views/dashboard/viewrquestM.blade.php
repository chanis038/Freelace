@extends('commons.viewrequesttemplate')

@section('filescontent')  
    
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

 
@endsection

@section('addscripts') 
<style type="text/css">
  #the-canvas {
  border: 1px solid black;
  direction: ltr;
}

</style>

<script src="{{asset('Plugins/pdfjs/build/pdf.js')}}">
</script>

<script type="text/javascript">
      var urlSource ="{{asset('/Solicitudes/'.$data[0]->ruta.'SAE_'.$data[0]->id.'.pdf')}}",
        worker = "{{asset('Plugins/pdfjs/build/pdf.worker.js')}}";

 </script>
 <script src="{{asset('Customs/js/customviewerPDF.js')}}">
</script>
@endsection
