<?php

/*
 * Proy. S&S Travels International
 */

/**
 * Description of comentario_origenDAO
 *
 * @author USUARIO
 */
class comentario_origenDAO {
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "systravel");
        //$cn = mysqli_connect("localhost:3306", "ctaperu6_systraveladmin", "e43ae23sm2Mic10Cap4Pas95la54n", "ctaperu6_systravel");
        $sql ="select * from comentario_origen";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $com_ori= new comentario_origen($row['idcomentario_origen'],$row['nombre_com_ori']);
            $vec[]= $com_ori;
        }
        return $vec;
    }
    
    function seleccionar_idcomentario_origen(comentario_origen $comentario_origen){
        $cn = mysqli_connect("localhost", "root", "", "systravel");
        //$cn = mysqli_connect("localhost:3306", "ctaperu6_systraveladmin", "e43ae23sm2Mic10Cap4Pas95la54n", "ctaperu6_systravel");
        $sql =" select * from comentario_origen where idcomentario_origen=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcomentario_origen=$comentario_origen->getidcomentario_origen();
        mysqli_stmt_bind_param($stmt,"i",$idcomentario_origen);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $com_ori= new comentario_origen($row['idcomentario_origen'],$row['nombre_com_ori']);
            return $com_ori;
        }else{
            return false;
        }
    }
    
}
