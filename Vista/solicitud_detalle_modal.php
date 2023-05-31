<?php
$s = $solicituddao->seleccionar_id($solicitud->getId());

?>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$s->getId()?>">
    Detalles
</button>
<div class="modal fade" id="exampleModal<?=$s->getId()?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitud: <?=$s->getId()?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <style>
            .filtro{
                display: none;
            }
        </style>
        <form>
            <table width="100%">
                <tr>
                    <td>Fecha de creacion:</td>
                    <td><input type="text" class="form-control" value="<?=$s->getFcreacion()?>" readonly=""></td>
                </tr>
                <tr>
                    <td>Prioridad:</td>
                    <td><input type="text" class="form-control" value="" readonly=""></td>
                </tr>
                <tr>
                    <td>Asunto:</td>
                </tr>
                <tr>
                    <td><input class="form-control" value="" readonly=""></td>
                </tr>
                <tr>
                    <td>Descripcion:</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" readonly="" rows="4"></textarea>
                    </td>
                </tr>
            </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>