<?php

namespace App\Console\Commands;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\Quantity;
use App\Models\Cart\Infrastructure\EloquentCartItemRepository;
use App\Models\Cart\Infrastructure\EloquentCartRepository;
use App\Models\Products\Infrastructure\EloquentProductRepository;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test:test';

    protected $description = 'Command to testing';

    public function handle(): void
    {
        if (! session()->has('cart')) {
            session(['cart' => new Cart(uniqid('cart_'))]);
        }

        $cartRepository = new EloquentCartRepository();
        $productRepository = new EloquentProductRepository();
        $cartItemRepository = new EloquentCartItemRepository();

        $cart = $cartRepository->searchOrCreate(session('cart')->id());
        $product = $productRepository->searchOrFail(4);
        $quantity = new Quantity(7);
        $item = CartItem::make($product, $quantity);
        $cartItemRepository->save($cart, $item);

        $cart = $cartRepository->searchOrCreate(session('cart')->id());
        $product = $productRepository->searchOrFail(3);
        $quantity = new Quantity(4);
        $item = CartItem::make($product, $quantity);
        $cartItemRepository->save($cart, $item);
    }
}
