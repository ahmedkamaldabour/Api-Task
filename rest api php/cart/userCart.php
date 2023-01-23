<?php

require_once('Auth/login.php');

$ch = curl_init();

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/cart',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST  => 'GET',
	CURLOPT_HTTPHEADER     => [
		'Authorization: Bearer '.$token,
	],
]);

$response = curl_exec($ch);
$response = json_decode($response, true);
print_r($response);