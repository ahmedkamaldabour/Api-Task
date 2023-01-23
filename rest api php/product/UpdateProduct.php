<?php

require_once('Auth/login.php');

$ch = curl_init();

// send the token in the header
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Bearer '.$token,
]);

$payload = [
	'name'    => 'test3 Update',
	'price'   => '1001',
	'stock'   => '101',
	'_method' => 'PUT',
];
$id = 14;

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/products/'.$id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST  => 'POST',
	CURLOPT_POSTFIELDS     => $payload,
]);

$respons = json_decode(curl_exec($ch), true);
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "\n";
echo $content_type."\n";
echo $status."\n";
echo "\n";
print_r($respons);
