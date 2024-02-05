## Siroko shop online

Requisites:
- A MySQL database named sirokodb must exist, with username root and empty password.
- Run php artisan app:reset to flush all tables and seed the app with 4 products. This command will also run two servers, one for the shop on port 8000 and another to listen for API requests on port 8080.
- Open http://localhost:8000 in your browser

We assume that the API doesn't need a valid token to be accessed. This API has 3 endpoints:

| Method | Endpoint | Params (json)                            | Return (json)                                                              |
|:-------|:---------|:-----------------------------------------|:---------------------------------------------------------------------------|
| POST   | /add     | -cart_id<br/> -product_id<br/> -quantity | -product_id<br/>-name<br/>-description<br/>-price<br/>-currency<br/>-image |
| PUT    | /update  |                                          |                                                                            |
| DELETE | /remove  |                                          |                                                                            |
