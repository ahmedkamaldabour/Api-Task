<?php

$name = 'Ahmed2';
$email = 'dabourdabour29@gmail.com';
$password = '12345678';

$url = 'http://localhost:8000/';


$ch = curl_init();

$payload = [
	'name'     => $name,
	'email'    => $email,
	'password' => $password,
];

curl_setopt_array($ch, [
	CURLOPT_URL            => $url.'api/register',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST           => true,
	CURLOPT_POSTFIELDS     => $payload,
]);

$response = curl_exec($ch);

curl_close($ch);

$response = json_decode($response, true);

echo '<pre>';
print_r($response);