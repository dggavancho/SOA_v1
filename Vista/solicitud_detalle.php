<?php
session_start();

//------------------------------------------------
include '../Modelo/solicitud.php';
include '../DAO/solicitudDAO.php';
$solicituddao = new solicitudDAO();
//------------------------------------------------

//------------------------------------------------
include '../Modelo/comentario.php';
include '../DAO/comentarioDAO.php';
$comentarioDAO = new comentarioDAO();
//------------------------------------------------

//------------------------------------------------
include '../Modelo/comentario_origen.php';
include '../DAO/comentario_origenDAO.php';
$comentario_origendao = new comentario_origenDAO();
//------------------------------------------------


$sol = new solicitud();
$sol->setId($_REQUEST['id']);
$s = $solicituddao->seleccionar_id($sol);

?>
<!--
Proyecto SOA
Autor: Diego Gavancho
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="../recursos/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        
        <div class="container">
            <br>
            <div class="row">
                <div class="col-4">
                    <table width="100%">
                        <tr>
                            <td width="10%" align="right">
                                <label>Nombre:</label>
                            </td>
                            <td><input class="form-control form-control-sm" disabled="" value="<?=$s->getSolicitante_nombre()?>"></td>
                        </tr>
                        <tr>
                            <td width="10%" align="right">
                                <label>Email:</label>
                            </td>
                            <td><input class="form-control form-control-sm" disabled="" value="<?=$s->getSolicitante_email()?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <h2>Solicitud: <?=$s->getId()?></h2>
                </div>
                <div class="col-2">Asignado:<?php if($s->getLeido()){echo "Si";}else{echo "No";}?></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Tipo de solicitud:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getTipo()?>" readonly=""></div>
                <div class="col-2" style="text-align: right;">Impacto:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getImpacto()?>" readonly=""></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Estado:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getEstado()?>" readonly=""></div>
                <div class="col-2" style="text-align: right;">Urgencia:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getUrgencia()?>" readonly=""></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Tecnico:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getTecnico()?>" readonly=""></div>
                <div class="col-2" style="text-align: right;">Prioridad:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getPrioridad()?>" readonly=""></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Categoria:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getCategoria()?>" readonly=""></div>
                <div class="col-2" style="text-align: right;">Fecha de creacion:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getFcreacion()?>" readonly=""></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Sugcategoria:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getSubcategoria()?>" readonly=""></div>
                <div class="col-2" style="text-align: right;">Fecha de vencimiento:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getFvencimiento()?>" readonly=""></div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-2" style="text-align: right;">Articulo:</div>
                <div class="col-3"><input type="text" class="form-control" value="<?=$s->getArticulo()?>" readonly=""></div>
                
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-10" >
                    Asunto:
                    <input class="form-control" value="<?=$s->getAsunto()?>" readonly="">
                </div>
            </div>
            <div class="row">
                <div class="col-12"><br></div>
            </div>
            <div class="row">
                <div class="col-10">
                    Descripcion:
                    <?=$s->getDescripcion()?>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                   <?php
                    $idorigen = $s->getId();
                    $idcomentario_origen = 1;
                    $destino_de_regreso = "../solicitud_detalle.php?id=".$s->getId();
                    ?>
                    <?php 
                    /*
                    Variables que necesita el modal comentario:
                    $idcomentario_origen: La entidad a la cual pertenece el comentario (Ver tabla Comentario Origen)
                    $idorigen: El id del objeto al cual se la va a agregar el comentario
                    $destino_de_regreso: La pagina a la cual se va a regresar despues de ingresado el comentario
                    */
                    include './modals/comentario_modal.php'; 
                    //Borrar los valores cargados para no interferir con otras utilización del modal
                    $idorigen = null;
                    $idcomentario_origen = null;
                    $destino_de_regreso = null;
                    ?>
                </div>
            </div>
            
                
            
        </div>
        
    </body>
</html>
