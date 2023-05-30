<?php
$url = 'https://localhost:8080/api/v3/requests';
$AUTHTOKEN = array(
    'authtoken'=>'4D8935BF-93A5-40B2-9E0F-730C3CAC118F'
);
$input_data = array(
    'request' => array(
        'subject' => 'Impresora no funciona',
        'description' => 'No puedo utilizar la impresora para imprimir las boletas de los clientes.',
        'requester' => array(
            'id' => '11',
            'name'=> 'Diego'
        ),
        'impact_details'=>'No se puede atender a los clientes',
        'status'=>array(
            'name'=>'Open'
        )
    )
);
echo json_encode($input_data)."<br><br>";
echo json_encode($AUTHTOKEN)."<br><br>";
$params = array(
    'input_data'=>json_encode($input_data)
);



$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

foreach ($AUTHTOKEN as $header){
    curl_setopt($curl, CURLOPT_HTTPHEADER, header($header));
}
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($curl);

if ($response === false) {
    // Manejar el error
    die('Error al realizar la solicitud a la API: ' . curl_error($curl));
}



$res = json_decode($response, true); 

echo $response;

curl_close($curl);

