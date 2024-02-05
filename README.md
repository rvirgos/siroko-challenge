## Siroko shop online

Requisites:
- A MySQL database named sirokodb must exist, with username root and empty password.
- Run php artisan app:reset to flush all tables and seed the app with 4 products.
- Run php artisan serve for the shop to listen for requests on default port 8000
- Run php artisan serve --port=8080 for the API to listen for requests on port 8080.
- Open http://localhost:8000 in your browser

We assume that the API doesn't need a valid token to be accessed. This API has 3 endpoints:

| Method | Endpoint | Function                                           |
|:-------|:---------|:---------------------------------------------------|
| POST   | /add     | Add an item to the shopping cart                   |
| PUT    | /update  | Change the quantity of a given product in the cart |                                                                                     |
| DELETE | /remove  | Remove an item from the shopping cart              |                                                                                     |
| GET    | /count   | Retrieves the number of items in the cart          |                                                                                     |

## /add endpoint
### Params
JSON encoded:
- cart_id. The ID of the cart where the item will be stored
- product_id. The ID of the product that will be added to the cart
- quantity. The amount of products to be added

### Returns
JSON encoded data from the inserted product and the amount added:
- cart_id
- item_id
- product_id
- name
- description
- price
- currency
- image
- quantity

## /update endpoint
### Params
JSON encoded:
- cart_id. The ID of the cart where the item will be stored
- cart_item_id. The ID of the item that will be updated
- quantity. The amount of products to be added

### Returns
JSON encoded data from the updated product and the new amount:
- cart_id
- item_id
- product_id
- name
- description
- price
- currency
- image
- quantity
- 
## /remove endpoint
### Params
JSON encoded:
- cart_id. The ID of the cart where the item will be removed
- cart_item_id. The ID of the item that will be removed

### Returns
JSON encoded data from the updated cart:
- cart_id

## /count endpoint
### Params
JSON encoded:
- cart_id. The ID of the cart where the items will be counted

### Returns
JSON encoded the number of items:
- count

