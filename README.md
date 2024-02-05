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

## /add endpoint
### Params
JSON encoded:
- cart_id. The ID of the cart where the item will be stored
- product_id. The ID of the product that will be added to the cart
- quantity. The amount of products to be added

### Returns
JSON encoded fields from the inserted product and the amount added:
- product_id
- name
- description
- price
- currency
- image
- quantity
