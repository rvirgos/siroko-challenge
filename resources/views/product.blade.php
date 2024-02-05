@php
$formatter = new NumberFormatter( 'es_ES', NumberFormatter::CURRENCY);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>{{ $info->name() }} - Tienda Siroko online</title>
    </head>
    <body>
        <h1>{{ $info->name() }} - Siroko</h1>
        <img src="{{ asset('images/' . $info->image()) }}" alt="Producto">
        <p class="desc">{{ $info->description() }}</p>
        <p class="price">{{ $formatter->formatCurrency($info->price()->value(), env('DEFAULT_CURRENCY')) }}</p>
        <form method="post" action="{{ route('cartAddItem') }}">
            @csrf
            <label>
                Cantidad a comprar
                <input name="quantity" type="number" min="1" step="1" value="1">
            </label>
            <input name="product_id" type="hidden" value="{{ $info->id() }}">
            <button type="submit">Comprar</button>
        </form>
        <a href="{{ route('listProducts') }}">Volver</a>
    </body>
</html>
