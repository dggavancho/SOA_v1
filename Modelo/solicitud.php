<?php


class solicitud {
    //
    private $id;
    private $tipo;
    private $estado;
    private $tecnico;
    private $impacto;
    private $urgencia;
    private $prioridad;
    private $categoria;
    private $subcategoria;
    private $articulo;
    private $asunto;
    private $descripcion;
    private $leido;
    private $fcreacion;
    private $fvencimiento;
    private $solicitante_nombre;
    private $solicitante_email;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTecnico() {
        return $this->tecnico;
    }

    function getImpacto() {
        return $this->impacto;
    }

    function getUrgencia() {
        return $this->urgencia;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getSubcategoria() {
        return $this->subcategoria;
    }

    function getArticulo() {
        return $this->articulo;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getLeido() {
        return $this->leido;
    }

    function getFcreacion() {
        return $this->fcreacion;
    }

    function getFvencimiento() {
        return $this->fvencimiento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }

    function setImpacto($impacto) {
        $this->impacto = $impacto;
    }

    function setUrgencia($urgencia) {
        $this->urgencia = $urgencia;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setSubcategoria($subcategoria) {
        $this->subcategoria = $subcategoria;
    }

    function setArticulo($articulo) {
        $this->articulo = $articulo;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setLeido($leido) {
        $this->leido = $leido;
    }

    function setFcreacion($fcreacion) {
        $this->fcreacion = $fcreacion;
    }

    function setFvencimiento($fvencimiento) {
        $this->fvencimiento = $fvencimiento;
    }

    function getSolicitante_nombre() {
        return $this->solicitante_nombre;
    }

    function getSolicitante_email() {
        return $this->solicitante_email;
    }

    function setSolicitante_nombre($solicitante_nombre) {
        $this->solicitante_nombre = $solicitante_nombre;
    }

    function setSolicitante_email($solicitante_email) {
        $this->solicitante_email = $solicitante_email;
    }

    function getPrioridad() {
        return $this->prioridad;
    }

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }


    
    
}
