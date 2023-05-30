<?php

$url = 'https://localhost:8080/api/v3/requests';
$KEY = "4D8935BF-93A5-40B2-9E0F-730C3CAC118F";

$headers = array(
    'authtoken'=>$KEY,
);

$input_data = array(
    'list_info' => array(
        'sort_field' => 'id',
        'sort_order' => 'asc',
        'get_total_count' => true,
        'search_fields' => array(
            'requester.id' => '11'
        )
    )
);

echo json_encode($input_data)."<br><br>";
$params = array(
    'input_data'=>json_encode($input_data)
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_GET, true);
//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($curl);

if ($response === false) {
    // Manejar el error
    die('Error al realizar la solicitud a la API: ' . curl_error($curl));
}

$res = json_decode($response, true); 

echo $response;

curl_close($curl);