This repo contains example scripts for using the Ordoro API. Check out [the complete API documentation](http://docs.ordoro.apiary.io/) for more information.

***

# API Basics

#### Authentication

We use basic auth. Your username can be found under settings->users in your Ordoro account.

#### Format

JSON in, JSON out

***

# Examples

### Getting new orders

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' https://api.ordoro.com/order/?status=new
```

### Getting products

```sh
curl --user 'myusername:mypassword' https://api.ordoro.com/product/?status=active
```

### Setting product inventory

__NOTE__ When we import an order, we automatically decrease the available on hand so there's no need to change it manually based on orders.

1. Setting inventory levels during initial setup
2. Updating inventory levels regularly based on external feeds (for example, via supplier inventory feeds)

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request PUT --data '{"on_hand":99}' https://api.ordoro.com/product/:sku/warehouse/:warehouse_id/
```

### Save tracking number

You must first create a shipment. Using this endpoint, we’ll automatically put the order lines into the shipment that have enough inventory to be fulfilled. You can then modify the shipment lines if necessary. You can also create a shipment directly if that’s more convenient.

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST https://api.ordoro.com/order/:order_id/create_shipment/
```

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request PUT --data '{"quantity":99}' https://api.ordoro.com/shipment/:shipment_id/line/:line_id/
```

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST --data '{"notify_cart":true, "tracking":{"shipping_method: "fast","tracking":91728387,"vendor":"UPS","cost":55}}' https://api.ordoro.com/shipment/:shipment_id/tracking/
```

### Create order

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST --data '{"order_id": "unique-order-id", "billing_address": {"name": "Frank"}, "shipping_address": {"name": "John"}}' https://api.ordoro.com/order/
```

### Create product

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST --data '{"sku": "unique-sku", "name": "displayme"}' https://api.ordoro.com/product/
```

### Get tracking information

The tracking information is stored in the tracking field of the shipment

```sh
curl --user 'myusername:mypassword' https://api.ordoro.com/shipment/:shipment_id/
```
