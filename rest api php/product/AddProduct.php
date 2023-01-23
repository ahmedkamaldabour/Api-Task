<?php

require_once('Auth/login.php');
die();
$ch = curl_init();

// send the token in the header
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Bearer '.$token,
]);

$payload = [
	'name'  => 'test4',
	'price' => '100',
	'stock' => '10',
];

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/products',
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

