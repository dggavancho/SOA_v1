<?php


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
    
    function seleccionar_id(solicitud $sol){
        $url = 'http://localhost:5000/api/solicitud_detalle/'.$sol->getId();
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
        
        if($solicitud['request_type']==null){
             $s->setTipo("No asignado");
        }else{
            $s->setTipo($solicitud['request_type']['name']);
        }
        if($solicitud['status']==null){
            $s->setEstado("No asignado");
        }else{
            $s->setEstado($solicitud['status']['name']);
        }
        if($solicitud['technician']!=null){
            $s->setTecnico($solicitud['technician']['name']);
        }else{
            $s->setTecnico("No asignado");
        }
        if($solicitud['impact']==null){
            $s->setImpacto("No asignado");
        }else{
            $s->setImpacto($solicitud['impact']['name']);
        }
        if($solicitud['urgency']==null){
            $s->setUrgencia("No asignado");
        }else{
            $s->setUrgencia($solicitud['urgency']['name']);
        }
        if($solicitud['priority']==null){
            $s->setPrioridad("No asignado");
        }else{
            $s->setPrioridad($solicitud['priority']['name']);
        }
        if($solicitud['category']==null){
            $s->setCategoria("No asignado");
        }else{
            $s->setCategoria($solicitud['category']['name']);
        }
        if($solicitud['subcategory']==null){
            $s->setSubcategoria("No asignado");
        }else{
            $s->setSubcategoria($solicitud['subcategory']['name']);
        }
        if($solicitud['item']==null){
            $s->setArticulo("No asignado");
        }else{
            $s->setArticulo($solicitud['item']['name']);
        }
        $s->setAsunto($solicitud['subject']);
        $s->setDescripcion($solicitud['description']);
        $s->setLeido($solicitud['is_read']);
        $epoch_fcreacion = intval($solicitud['created_time']['value'])/1000;;
        $date_fcreacion = new DateTime("@$epoch_fcreacion");
        $s->setFcreacion($date_fcreacion->format('Y-m-d H:i:s'));
        if($solicitud['due_by_time']==null){
             $s->setFvencimiento("No asignado");
        }else{
            $epoch_fvencimiento = intval($solicitud['due_by_time']['value'])/1000;;
            $date_fvencimiento = new DateTime("@$epoch_fvencimiento");
            $s->setFvencimiento($date_fvencimiento->format('Y-m-d H:i:s'));
        }
        $s->setSolicitante_nombre($solicitud['requester']['name']);
        $s->setSolicitante_email($solicitud['requester']['email_id']);
        return $s;
    }
    
    function crear(solicitud $sol, $token){
        $url = 'http://localhost:5000/api/solicitud_crea';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = array(
            "authtoken"=>$token,
            "asunto"=>$sol->getAsunto(),
            "descripcion"=>$sol->getDescripcion()
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
        echo $res;
    }
    
}
