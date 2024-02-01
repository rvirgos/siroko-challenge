@php
$formatter = new NumberFormatter( 'es_ES', NumberFormatter::CURRENCY);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>{Carrito - Tienda Siroko online</title>
    </head>
    <body>
        <h1>Carrito - Siroko</h1>
        <table>
            <thead>
            <tr>
                <th>Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Subtotal</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            @foreach ($items as $item)
                <tr>
                    <td><img src="{{ asset('images/' . $item->product()->image()) }}" alt=""></td>
                    <td>{{ $item->product()->name() }}</td>
                    <td>{{ $item->quantity()->value() }}</td>
                    <td>{{ $formatter->formatCurrency($item->product()->price()->value(), env('DEFAULT_CURRENCY')) }}</td>
                    <td>{{ $formatter->formatCurrency($item->subTotal()->value(), env('DEFAULT_CURRENCY')) }}</td>
                    <td><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        </table>
        <p class="price">Total: {{ $formatter->formatCurrency($total->value(), env('DEFAULT_CURRENCY')) }}</p>
        <a href="{{ route('listProducts') }}">Seguir comprando</a>
    </body>
</html>
