<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comentario_modal<?=$idorigen?>">
    Comentarios
</button>
<div class="modal fade" id="comentario_modal<?=$idorigen?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
        
            
        
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios de <?=$comentario_origendao->seleccionar_idcomentario_origen(new comentario_origen($idcomentario_origen, null))->getNombre_com_ori()." ".$idorigen?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" action="./procesos/p_comentario.php?&accion=create">
      <div class="modal-body">
        <style>
            .collapsible {
                cursor: pointer;
                padding: 5px;
                width: 100%;
                border: none;
                text-align: center;
                outline: none;
                font-size: 15px;
              }

              /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
              .active, .collapsible:hover {
                background-color: #ccc;
              }

              /* Style the collapsible content. Note: hidden by default */
              .content {
                padding: 0 18px;
                display: none;
                overflow: hidden;
              }

              .content {
                padding: 0 18px;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease-out;
              }

        </style>
        <div class="container-fluid">
            <?php
                foreach ($comentarioDAO->seleccionar_idorigen_idcomentario_origen(new comentario(null, $idorigen, $idcomentario_origen, null, null, null)) as $kcg=>$dcomres){
                ?>
            <div class="row" style="">
                
                <div class="col-12" style="border-bottom: 1px solid #DDDDDD;">
                    <button type="button" class="collapsible" style="padding: 0px; margin: 0px;">
                        <div class="container-fluid">
                            <div class="row" style="padding: 12px 15px;">
                                <div class="col-8" style="text-align: left">
                                    <b><?=$dcomres->gettitulo_com()?></b>
                                </div>
                                <div class="col-4" style="text-align: right">
                                    <?=date("d/m/Y h:i:sa", strtotime($dcomres->getfcreacion_com()))?>
                                </div>
                            </div>
                        </div>
                    </button>
                    <div class="content" style="padding-left: 5%;padding-right: 5%;"><p ><?=$dcomres->getcuerpo_com()?></p></div>
                </div>
                
            </div>
            <?php
                }
                ?>
            <div class="row">
                <div col-12>
                    <br><br>
                </div>
            </div>
            <div class="row">
                <div col-12>
                    <h4>Agregar comentario</h4>
                </div>
            </div>
            <div class="row">
                <div col-12>
                    <input type="text"  name="titulo_com" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div col-12>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <textarea cols="80" rows="6" style="resize: none; border: 1px solid #ced4da; border-radius: 0.25rem;" name="cuerpo_com" required id="comentario<?=$idorigen?>"></textarea>
                    <script>CKEDITOR.replace('comentario<?=$idorigen?>');</script>
                    <input type="hidden" name="ruta" value="<?=$destino_de_regreso?>" required>
                    <input type="hidden" name="idorigen" value="<?=$idorigen?>" required>
                    <input type="hidden" name="idcomentario_origen" value="<?=$idcomentario_origen?>" required>
                </div>
            </div>
        </div>
        
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit"  class="btn btn-primary" value="Agregar">
      </div>
        </form>
    </div>
  </div>
</div>