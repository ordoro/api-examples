This repo contains example scripts for using the Ordoro API.
- Check out [the complete API documentation](http://docs.ordoro.apiary.io/) for more information.
- And the [v3 Orders API](https://devapiverson.docs.apiary.io) for any order related actions.

__NOTE__ Orders will use a different version of the API, but all other actions will use the base API and documentation.

***

# API Basics

#### Authentication

We use Basic Auth.
You can generate API Keys under Settings->API Keys in your Ordoro account and use them accordingly.

#### Format

JSON in, JSON out

***

# Examples

### Getting new orders

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' https://api.ordoro.com/v3/order?status=awaiting_fulfillment
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

### Create order

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST https://api.ordoro.com/v3/order --data '{
  "billing_address": {
    "city": "austin",
    "country": "USA",
    "email": "mrgattispizza@delivers.com",
    "name": "James Eure",
    "phone": "4592222",
    "state": "tx",
    "street1": "123 foo-bar ln",
    "zip": "78701"
  },
  "cart": 100,
  "cart_order_id": "thats-some-funky-1234",
  "grand_total": 123.45,
  "lines": [
    {
      "cart_orderitem_id": "abc.123",
      "product": {
        "amazon_extra_info": {
          "asin": "55555",
          "listing_id": "12356",
          "pending_quantity": 4
        },
        "cost": 1.69,
        "name": "special product name",
        "price": 69.69,
        "sku": "sku1",
        "taxable": "false",
        "weight": 1.0
      },
      "quantity": 2
    },
    {
      "cart_orderitem_id": "abc.456",
      "product": {
        "cost": 3.45,
        "name": "Plastic Toy",
        "price": 1.23,
        "sku": "sku2",
        "taxable": "false",
        "weight": 2.0
      },
      "quantity": 1
    }
  ],
  "order_date": "2015-12-09T12:01:00.855700",
  "order_id": "order-1234",
  "product_amount": 100.1,
  "shipping_address": {
    "city": "austin",
    "country": "USA",
    "email": "jenny@igotyournumber.com",
    "name": "Tommy Tutone",
    "phone": "8675309",
    "state": "tx",
    "street1": "123 foo-bar ln",
    "zip": "78701"
  },
  "tags": [
    {
      "color": "#FFFFFF",
      "text": "Unpaid"
    },
    {
      "color": "#C0C0C0",
      "text": "Alert"
    }
  ],
  "tax_amount": 1.23
}'
```

### Save tracking number

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST --data '{"tracking_number": "1234-lkjd", "cost": 7.00, "ship_date": "2016-03-07T06:06:06.123456-06:00", "shipping_method": "rail", "carrier_name": "DHL", "notify_bill_to": false, "notify_ship_to": true, "notify_cart": true}' https://api.ordoro.com/v3/order/:order_number/shipping_info
```

### Create product

```sh
curl --user 'myusername:mypassword' --header 'Content-Type: application/json' --request POST --data '{"sku": "unique-sku", "name": "displayme"}' https://api.ordoro.com/product/
```

### Get tracking information

The tracking information is stored in the shipping_info field of the order.

```sh
curl --user 'myusername:mypassword' https://api.ordoro.com/v3/order/:order_number
```
