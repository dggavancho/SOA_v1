<?php
session_start();

//------------------------------------------------
include '../Modelo/solicitud.php';
include '../DAO/solicitudDAO.php';
$solicituddao = new solicitudDAO();

//------------------------------------------------


?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            
                    
                
        <?php
        
        $solicitud_lista = $solicituddao->seleccionar();
        
        ?>
            <br>
            <div class="row">
                <div class="col-4">
                    <table width="100%">
                        <tr>
                            <td width="10%" align="right">
                                <label>Nombre:</label>
                            </td>
                            <td><input class="form-control form-control-sm" disabled="" value="<?=$solicitud_lista[0]->getSolicitante_nombre()?>"></td>
                        </tr>
                        <tr>
                            <td width="10%" align="right">
                                <label>Email:</label>
                            </td>
                            <td><input class="form-control form-control-sm" disabled="" value="<?=$solicitud_lista[0]->getSolicitante_email()?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
                    
            <div class="row ">
                <div class="col-12">
                    <table  width="50%" class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Asunto</th>
                                <th>Estado</th>
                                <th>Técnico</th>
                                <th></th>
                            </tr>
                        </thead>


                    <?php



                    foreach($solicitud_lista as $solicitud){
                        ?>

                        <tr>
                            <td><?=$solicitud->getId()?></td>
                            <td><?=$solicitud->getAsunto()?></td>
                            <td><?=$solicitud->getEstado()?></td>
                            <td><?=$solicitud->getTecnico()?></td>
                            <td>
                                <?php include './solicitud_detalle_modal.php'; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    
                </div>
            </div>
        </div>
    </body>
</html>
