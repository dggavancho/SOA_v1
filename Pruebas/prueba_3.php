<?php

$url = 'https://reqres.in/api/users';


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);


$data = array(
    "name"=>"Juan",
    "job"=>"Perez"
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

echo $response;

curl_close($curl);