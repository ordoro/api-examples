<?php
$ch = curl_init();

# Use your ordoro username/password here
$username = 'johnnyuser@yoursite.com';
$password = 'supersecret';

$url = 'https://api.ordoro.com/order/';
# This is the minimum amount of data required to create an order
# For more information on which params are valid, check the docs http://docs.ordoro.apiary.io/#reference/order/order/post
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
curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$response = curl_exec($ch);
curl_close($ch);

print $response;
