<?php
$ch = curl_init();

# Use your Ordoro API Key client_id/client_secret here
$client_id = 'your-client-id';
$client_secret = 'your-client-secret';

# For more information on process_dropshipments, check the docs https://docs.ordoro.com/#tag/Order/operation/OrderProcessDropshipmentsByOrderNumber_POST
$url = 'https://api.ordoro.com/order/v3/M-1234/process_dropshipments';
$data = array();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$response = curl_exec($ch);
curl_close($ch);

print $response;
