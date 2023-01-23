<?php

require_once('Auth/login.php');


$ch = curl_init();

// send the token in the header
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Bearer '.$token,
]);

$id = 1;

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/products/'.$payload['id'],
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST  => 'DELETE',
]);

$response = curl_exec($ch);

curl_close($ch);


$response = json_decode($response, true);

echo '<pre>';
print_r($response);
