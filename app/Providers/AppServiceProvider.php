<?php

namespace App\Providers;

use App\Models\Cart\Domain\CartItemRepository;
use App\Models\Cart\Domain\CartRepository;
use App\Models\Cart\Infrastructure\EloquentCartItemRepository;
use App\Models\Cart\Infrastructure\EloquentCartRepository;
use App\Models\Products\Domain\ProductRepository;
use App\Models\Products\Infrastructure\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductRepository::class, function ($app) {
            return new EloquentProductRepository();
        });
        $this->app->singleton(CartRepository::class, function ($app) {
            return new EloquentCartRepository();
        });
        $this->app->singleton(CartItemRepository::class, function ($app) {
            return new EloquentCartItemRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
