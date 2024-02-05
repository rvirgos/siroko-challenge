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
                    <td>
                        <form class="removeFrm" method="post" action="{{ route('cartRemoveItem', [
                            'cart_id' => session('cart')->id(),
                            'cart_item_id' => $item->id(),
                        ]) }}">
                            @csrf
                            <button type="submit">🗑</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <p>{{ $count }} elementos en el carrito.</p>
        <p class="price">Total: {{ $formatter->formatCurrency($total->value(), env('DEFAULT_CURRENCY')) }}</p>
        <a href="{{ route('listProducts') }}">Seguir comprando, o</a>
        <form method="post" action="{{ route('cartCheckout', [
            'cart_id' => session('cart')->id(),
            'cart_item_id' => $item->id(),
        ]) }}">
            @csrf
            <br><button type="submit">Finalizar compra</button>
        </form>
    <script>
        window.onload = function () {
            let frms = document.getElementsByClassName('removeFrm');
            for (i in frms) {
                frms[i].onsubmit = function () {
                    return window.confirm('¿Borrar seguro?');
                };
            }
        };
    </script>
    </body>
</html>
