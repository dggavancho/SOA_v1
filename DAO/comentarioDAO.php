<?php

/*
 * Proy. S&S Travels International
 */

/**
 * Description of comentarioDAO
 *
 * @author USUARIO
 */
class comentarioDAO {
    
    function seleccionar(){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql ="select * from comentario";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $com= new comentario($row['idcomentario'],$row['idorigen'],$row['idcomentario_origen'],$row['titulo_com'],$row['cuerpo_com'],$row['fcreacion_com']);
            $vec[]= $com;
        }
        return $vec;
    }
    
    function seleccionar_idcomentario(comentario $comentario){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql =" select * from comentario where idcomentario=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcomentario=$comentario->getidcomentario();
        mysqli_stmt_bind_param($stmt,"i",$idcomentario);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $com= new comentario($row['idcomentario'],$row['idorigen'],$row['idcomentario_origen'],$row['titulo_com'],$row['cuerpo_com'],$row['fcreacion_com']);
            return $com;
        }else{
            return false;
        }
    }
    
    function seleccionar_idorigen_idcomentario_origen(comentario $comentario){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql =" select * from comentario where idcomentario_origen=? AND idorigen=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idcomentario_origen=$comentario->getidcomentario_origen();
        $idorigen=$comentario->getidorigen();
        mysqli_stmt_bind_param($stmt,"ii",$idcomentario_origen,$idorigen);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $vec = [];
        while($row = mysqli_fetch_assoc($resultData)){
            $com= new comentario($row['idcomentario'],$row['idorigen'],$row['idcomentario_origen'],$row['titulo_com'],$row['cuerpo_com'],$row['fcreacion_com']);
            $vec[]= $com;
        }
        return $vec;
    }
    
    
    function crear(comentario $comentario){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql =" INSERT INTO comentario (idorigen,idcomentario_origen,titulo_com,cuerpo_com,fcreacion_com) VALUES (?,?,?,?,NOW())";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $ido = $comentario->getidorigen();
        $idc_ori = $comentario->getidcomentario_origen();
        $tit_com = $comentario->gettitulo_com();
        $cue_com = $comentario->getcuerpo_com();
        mysqli_stmt_bind_param($stmt, "iiss",$ido,$idc_ori,$tit_com,$cue_com);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function actualizar(comentario $comentario){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql =" UPDATE comentario SET idorigen=?,idcomentario_origen=?,titulo_com=?,cuerpo_com=?,fcreacion_com=? WHERE idcomentario=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idc = $comentario->getidcomentario();
        $ido = $comentario->getidorigen();
        $idc_ori = $comentario->getidcomentario_origen();
        $tit_com = $comentario->gettitulo_com();
        $cue_com = $comentario->getcuerpo_com();
        $fcr_com = $comentario->getfcreacion_com();
        mysqli_stmt_bind_param($stmt, "iisssi",$ido,$idc_ori,$tit_com,$cue_com,$fcr_com,$idc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function eliminar(comentario $comentario){
        $cn = mysqli_connect("localhost", "root", "", "soa_s_autenticacion");
        
        $sql =" delete from comentario WHERE idcomentario=?";
        $stmt = mysqli_stmt_init($cn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error statement";
        }
        $idc = $comentario->getidcomentario();
        mysqli_stmt_bind_param($stmt,"i",$idc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
}
