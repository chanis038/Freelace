<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addcomment">
  Agregar comentario
</button>

<!-- Modal -->
<div class="modal fade" id="addcomment" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Agregue su comentario</h5>
      </div>
      <div class="modal-body">
       <textarea   class="form-control" id="comment" maxlength=191>{{$request->observacion}}</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="save" data-dismiss="modal" >Guardar</button>
      </div>
    </div>
  </div>
</div>