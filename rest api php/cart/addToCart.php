<?php

require_once('Auth/login.php');

$ch = curl_init();

// send the token in the header
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Bearer '.$token,
]);

$payload = [
	'product_id' => '9',
	'count'      => '5',
];

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/cart',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST           => true,
	CURLOPT_POSTFIELDS     => $payload,
]);
$response = curl_exec($ch);
$response = json_decode($response, true);
//$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
//$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
//echo "\n";
//echo $content_type."\n";
//echo $status."\n";
//echo "\n";
print_r($response);

