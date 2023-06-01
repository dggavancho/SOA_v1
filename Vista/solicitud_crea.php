<?php

/* 
 * Proyecto SOA
 * Autor: Diego Gavancho
 */

?>

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crea_solicitud">
    Agregar
</button>
<div class="modal fade" id="crea_solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva solicitud</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" action="../Controlador/p_handler.php?action=create">
      <div class="modal-body">
          <style>
            .filtro{
                display: none;
            }
        </style>
            <table width="100%">
                <tr>
                    <td>
                        Asunto:
                        <input class="form-control" name="asunto" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        Descripcion:
                        <textarea name="descripcion" id="editor1"></textarea>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </td>
                </tr>
            </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-success" value="Agregar">
      </div>
        </form>
    </div>
  </div>
</div>



