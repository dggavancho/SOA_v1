<?php

/* 
 * Proy. S&S Travels International
 */




//Recursos
include_once '../../DAO/comentarioDAO.php';
include_once '../../Modelo/comentario.php';
$comentarioDAO = new comentarioDAO();
//---------------------------------------------------------------
//---------------------------------------------------------------


$accion = $_REQUEST['accion'];

if($accion=="create"){ 
    $comentario = new comentario(null, $_POST['idorigen'], $_POST['idcomentario_origen'], $_POST['titulo_com'], $_POST['cuerpo_com'], null);
    $comentarioDAO->crear($comentario);
    echo "<script>window.location.href='".$_POST['ruta']."';</script>";
}

if($accion=="update"){
    
} 

if($accion=="delete"){
    
}