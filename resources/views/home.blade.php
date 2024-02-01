@php
    $formatter = new NumberFormatter( 'es_ES', NumberFormatter::CURRENCY);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>Home - Tienda Siroko online</title>
    </head>
    <body>
        <h1>Home - Siroko</h1>
        <table>
            <thead>
            <tr>
                <th>Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Más info</th>
            </tr>
            </thead>
            @foreach ($products as $product)
                <tr>
                    <td><a href="{{ $product->id() }}/product"><img src="{{ asset('images/' . $product->image()) }}" alt=""></a></td>
                    <td><a href="{{ $product->id() }}/product">{{ $product->name() }}</a></td>
                    <td>{{ $product->description() }}</td>
                    <td>{{ $formatter->formatCurrency($product->price()->value(), env('DEFAULT_CURRENCY')) }}</td>
                    <td><a href="{{ $product->id() }}/product">Ver más</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
