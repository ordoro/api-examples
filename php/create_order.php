<?php
$ch = curl_init();

# Use your Ordoro API Key client_id/client_secret here
$client_id = 'your-client-id';
$client_secret = 'your-client-secret';

$url = 'https://api.ordoro.com/v3/order';
# This is the minimum amount of data required to create an order
# For more information on which params are valid, check the docs https://docs.ordoro.com/#tag/Order/operation/Order_POST
$data = array(
    # The order ID should be unique
    'order_id' => '1234',
    'billing_address' => array(
        'name' => 'Jane Buyer'
    ),
    'shipping_address' => array(
        'name' => 'Charlie Shipper'
    ),
    'lines' => array(
        array(
            # The product will be created in Ordoro if the SKU doesn't already exist
            'product' => array(
                'sku' => 'Product 1',
                'name' => 'This is the description for the product'
            )
        )
    )
);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$response = curl_exec($ch);
curl_close($ch);

print $response;
