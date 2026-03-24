<?php
$ch = curl_init();

# Use your Ordoro API Key client_id/client_secret here
$client_id = 'johnnyuser@yoursite.com';
$client_secret = 'supersecret';

$url = 'https://api.ordoro.com/v3/order';
# All params are optional for fetching an orders list
# For more information on which params are valid, check the docs https://docs.ordoro.com/#tag/Order/operation/Order_GET
$params = array('status' => 'new', 'start_order_date' => '2025-07-01');
$url .= '?' . http_build_query($params);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$response = curl_exec($ch);
curl_close($ch);

print $response;
