<?php
//header.payload.signature

//header
$header = [
      'typ' => 'JWT',
      'alg' => 'HS256'
];

//payload
$payload = [
    'nome' => 'Paulo Henrique',
    'email' => 'paulo@gmail.com',
    'username' => 'paulinho',
    'exp' => (new \DateTime())->getTimestamp()
];

$key = '@na123456Teste';

$header_json = json_encode($header);
$header_base64 = base64_encode($header_json);

$payload_json = json_encode($payload);
$payload_base64 = base64_encode($payload_json);

//signature
$signature = hash_hmac('sha256', "$header_base64.$payload_base64", $key, true);
$signature_base64 = base64_encode($signature);
//echo "$header_base64.$payload_base64";
//echo $signature_base64;
echo "$header_base64.$payload_base64.$signature_base64";