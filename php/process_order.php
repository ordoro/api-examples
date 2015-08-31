<?php
$ch = curl_init();

// # Use your ordoro username/password here
$username = 'johnnyuser@yoursite.com';
$password = 'supersecret';

$url = 'https://api.ordoro.com/order/M-1234/process/';
$data = array();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$response = curl_exec($ch);
curl_close($ch);

print $response;
