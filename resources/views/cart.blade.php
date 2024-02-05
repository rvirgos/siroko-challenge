@php
$formatter = new NumberFormatter( 'es_ES', NumberFormatter::CURRENCY);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>Carrito - Tienda Siroko online</title>
    </head>
    <body>
        <h1>Carrito - Siroko</h1>
        <table>
            <thead>
            <tr>
                <th>Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Subtotal</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            @foreach ($items as $item)
                <tr>
                    <td><img src="{{ asset('images/' . $item->product()->image()) }}" alt=""></td>
                    <td>{{ $item->product()->name() }}</td>
                    <td>{{ $formatter->formatCurrency($item->product()->price()->value(), $item->product()->price()->currency()) }}</td>
                    <td>
                        <form method="post" action="{{ route('cartUpdateItem', [
                            'cart_id' => session('cart')->id(),
                            'cart_item_id' => $item->id(),
                        ]) }}">
                            @csrf
                            <input name="quantity" type="number" min="1" step="1" value="{{ $item->quantity()->value() }}">
                            <button type="submit">🔄</button>
                        </form>
                    </td>
                    <td>{{ $formatter->formatCurrency($item->subTotal()->value(), $item->product()->price()->currency()) }}</td>
                    <td><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        </table>
        <p class="price">Total: {{ $formatter->formatCurrency($total->value(), env('DEFAULT_CURRENCY')) }}</p>
        <a href="{{ route('listProducts') }}">Seguir comprando</a>
    </body>
</html>
