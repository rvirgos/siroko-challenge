<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>Siroko</title>
    </head>
    <body>
        <h1>Tienda Siroko online</h1>
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Comprar</th>
            </tr>
            </thead>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('images/' . $product->image()) }}" alt="Producto"></td>
                    <td><a href="{{ $product->id() }}/product">{{ $product->name() }}</a></td>
                    <td>{{ $product->description() }}</td>
                    <td>{{ number_format($product->price()->value(), 2) }}</td>
                    <td><a href="">Comprar</a></td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
