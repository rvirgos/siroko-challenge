<?php

namespace App\Console\Commands;

use App\Models\Cart\Domain\Cart;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class TestCommand extends Command
{
    protected $signature = 'test:test';

    protected $description = 'Command to testing';

    public function handle(): void
    {
        if (! session()->has('cart')) {
            session(['cart' => new Cart(uniqid('cart_'))]);
        }

        $productId = 1;
        $quantity = -1;

        $data = [
            'cart_id' => session('cart')->id(),
            'product_id' => $productId,
            'quantity' => $quantity,
        ];

        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'POST',
            (new Uri(route('cartAddItem')))->withPort(env('API_PORT')),
            ['Content-type' => 'application/json'],
            json_encode($data),
        ));

    }
}
