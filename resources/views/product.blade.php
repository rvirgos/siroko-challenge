<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
        <title>Siroko</title>
    </head>
    <body>
        <h1>{{ $info->name() }} - Tienda Siroko online</h1>
        <p>{{ $info->description() }}</p>
        <form method="post">
            @csrf
            <img src="{{ asset('images/' . $info->image()) }}" alt="Producto">
            <label>

            </label>
        </form>
    </body>
</html>
