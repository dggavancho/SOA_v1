<?php

/*
 * Proy. S&S Travels International
 */

/**
 * Description of comentario
 *
 * @author USUARIO
 */
class comentario {
    private $idcomentario;
    private $idorigen;
    private $idcomentario_origen;
    private $titulo_com;
    private $cuerpo_com;
    private $fcreacion_com;

    function __construct($idcomentario,$idorigen,$idcomentario_origen,$titulo_com,$cuerpo_com,$fcreacion_com){
        $this->idcomentario = $idcomentario;
        $this->idorigen = $idorigen;
        $this->idcomentario_origen = $idcomentario_origen;
        $this->titulo_com = $titulo_com;
        $this->cuerpo_com = $cuerpo_com;
        $this->fcreacion_com = $fcreacion_com;
    }

    function getidcomentario() {
        return $this->idcomentario;
    }

    function setidcomentario($idcomentario) {
        $this->idcomentario=$idcomentario;
    }

    function getidorigen() {
        return $this->idorigen;
    }

    function setidorigen($idorigen) {
        $this->idorigen=$idorigen;
    }

    function getidcomentario_origen() {
        return $this->idcomentario_origen;
    }

    function setidcomentario_origen($idcomentario_origen) {
        $this->idcomentario_origen=$idcomentario_origen;
    }

    function gettitulo_com() {
        return $this->titulo_com;
    }

    function settitulo_com($titulo_com) {
        $this->titulo_com=$titulo_com;
    }

    function getcuerpo_com() {
        return $this->cuerpo_com;
    }

    function setcuerpo_com($cuerpo_com) {
        $this->cuerpo_com=$cuerpo_com;
    }

    function getfcreacion_com() {
        return $this->fcreacion_com;
    }

    function setfcreacion_com($fcreacion_com) {
        $this->fcreacion_com=$fcreacion_com;
    }
}
