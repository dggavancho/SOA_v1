<?php

/*
 * Proy. S&S Travels International
 */

/**
 * Description of comentario_origen
 *
 * @author USUARIO
 */
class comentario_origen {
    private $idcomentario_origen;
    private $nombre_com_ori;

    function __construct($idcomentario_origen,$nombre_com_ori){
        $this->idcomentario_origen = $idcomentario_origen;
        $this->nombre_com_ori = $nombre_com_ori;
    }

    function getidcomentario_origen() {
        return $this->idcomentario_origen;
    }

    function setidcomentario_origen($idcomentario_origen) {
        $this->idcomentario_origen=$idcomentario_origen;
    }

    function getnombre_com_ori() {
        return $this->nombre_com_ori;
    }

    function setnombre_com_ori($nombre_com_ori) {
        $this->nombre_com_ori=$nombre_com_ori;
    }
}
