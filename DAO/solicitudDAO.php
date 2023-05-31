<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solicitudDAO
 *
 * @author USUARIO
 */
class solicitudDAO {
    
    function seleccionar(){
        $url = 'http://localhost:5000/api/solicitud_lista';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        
        $data = array(
            "authtoken"=>$_SESSION['authtoken']
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        if ($response === false) {
            // Manejar el error
            die('Error al realizar la solicitud a la API: ' . curl_error($curl));
        }

        $res = json_decode($response, true); 
        curl_close($curl);
        $vec = [];
        foreach($res['requests'] as $solicitud){
            $s = new solicitud();
            $s->setId($solicitud['id']);
            $s->setEstado($solicitud['status']['name']);
            if($solicitud['technician']!=null){
                $s->setTecnico($solicitud['technician']['name']);
            }else{
                $s->setTecnico("No asignado");
            }
            $s->setAsunto($solicitud['subject']);
            $s->setSolicitante_nombre($solicitud['requester']['name']);
            $s->setSolicitante_email($solicitud['requester']['email_id']);
            $vec[] = $s;
        }
        return $vec;
    }
    
    function seleccionar_id($id){
        $url = 'http://localhost:5000/api/solicitud_detalle/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = array(
            "authtoken"=>$_SESSION['authtoken']
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        if ($response === false) {
            // Manejar el error
            die('Error al realizar la solicitud a la API: ' . curl_error($curl));
        }
        $res = json_decode($response, true); 
        curl_close($curl);
        $solicitud = $res['request'];
        $s = new solicitud();
        $s->setId($solicitud['id']);
        $s->setTipo($solicitud['request_type']);
        $s->setEstado($solicitud['status']['name']);
        if($solicitud['technician']!=null){
            $s->setTecnico($solicitud['technician']['name']);
        }else{
            $s->setTecnico("No asignado");
        }
        $s->setImpacto($solicitud['impact']);
        $s->setUrgencia($solicitud['urgency']);
        $s->setPrioridad($solicitud['priority']);
        $s->setCategoria($solicitud['category']);
        $s->setSubcategoria($solicitud['subcategory']);
        $s->setArticulo($solicitud['item']);
        $s->setAsunto($solicitud['subject']);
        $s->setDescripcion($solicitud['description']);
        $s->setLeido($solicitud['is_read']);
        $epoch_fcreacion = intval($solicitud['created_time']['value'])/1000;;
        $date_fcreacion = new DateTime("@$epoch_fcreacion");
        $s->setFcreacion($date_fcreacion->format('Y-m-d H:i:s'));
        $epoch_fvencimiento = intval($solicitud['created_time']['value'])/1000;;
        $date_fvencimiento = new DateTime("@$epoch_fvencimiento");
        $s->setFvencimiento($date_fvencimiento->format('Y-m-d H:i:s'));
        $s->setFvencimiento($solicitud['id']);
        return $s;
    }
    
    
    
}
