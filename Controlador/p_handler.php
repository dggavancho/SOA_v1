<?php

$action = $_REQUEST['action'];

//--------------------------------------------------------
if($action=="login"){
    $url = 'http://localhost:5001/api/login';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $data = array(
        "employeeid"=>$_POST['employeeid']
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
    echo $res['authtoken'];
    session_start();
    $_SESSION['authtoken']=$res['authtoken'];
    header('location:../Vista/solicitud_lista.php');
}
//--------------------------------------------------------