<?php

require_once('Auth/login.php');


$ch = curl_init();

// send the token in the header
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Bearer '.$token,
]);

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/products',
	CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);
echo '<pre>';
print_r($response);