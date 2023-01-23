<?php

$email = 'dabourdabour28@gmail.com';
$password = '12345678';

$url = 'http://localhost:8000/';

function get_token($email, $password, $url)
{
	$ch = curl_init();

	curl_setopt_array($ch, [
		CURLOPT_URL            => $url.'api/login',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST           => true,
		CURLOPT_POSTFIELDS     => [
			'email'    => $email,
			'password' => $password,
		],
	]);

	$response = curl_exec($ch);
	$response = json_decode($response, true);
	return $response['authorisation']['token'];
}

$token = get_token($email, $password, $url);


