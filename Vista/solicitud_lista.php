<?php
session_start();
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
    </head>
    <body>
        <?php
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
        $solicitante = $res['requests'][0]['requester'];
        echo "Solicitante:<br>";
        echo "ID: ".$solicitante['id']."<br>";
        echo "Nombre: ".$solicitante['name']."<br>";
        echo "Email: ".$solicitante['email_id']."<br>";
        ?>
        <table border="1" width="50%">
            <tr>
                <th>ID</th>
                <th>Asunto</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Técnico</th>
            </tr>

        <?php



        foreach($res['requests'] as $solicitud){
            ?>
            <tr>
                <td><?=$solicitud['id']?></td>
                <td><?=$solicitud['subject']?></td>
                <td><?=$solicitud['short_description']?></td>
                <td><?=$solicitud['status']['name']?></td>
                <td><?php
                if($solicitud['technician']!=null){
                    echo $solicitud['technician']['name'];                    
                }else{
                    echo "No asignado";
                }
                ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </body>
</html>
