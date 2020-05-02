
 @if(session('response'))
      @if(session('response')=="2")
<div class="modal fade" id="conditions" tabindex="-1" role="dialog" aria-labelledby="conditions" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="conditions">Condiciones de Uso de información</h5>
      </div>
      <div class="modal-body">
        <p align="justify">{{session('result')}}</p>  
       <br>
       <p align="justify"><strong>Toda la información ingresada en esta sección es responsabilidad del usuario(Colaborador/Catedrático),si la comisión de verificación de información de la DIGED, encuentra información falsa o alterada, el usuario (Colaborador/Catedrático), sera penalizado bajo las reglas y normas de esta institución.</strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar y cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif
@endif