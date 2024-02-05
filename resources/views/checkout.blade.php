<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>Compra completada - Tienda Siroko online</title>
    </head>
    <body>
        <h1>Compra completada - Siroko</h1>
        <b>//TODO pago, mail, etc</b>
        <p>Su compra se ha realizado con éxito.</p>
        <a href="{{ route('listProducts') }}">Volver a la home</a>
    </body>
</html>
