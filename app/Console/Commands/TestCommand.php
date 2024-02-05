<?php

namespace App\Console\Commands;

use App\Models\Cart\Domain\Quantity;
use App\Models\Cart\Infrastructure\EloquentCartItemRepository;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;

class TestCommand extends Command
{
    protected $signature = 'test:test';

    protected $description = 'Command to testing';

    public function handle(): void
    {
        $cartId = 'cart_65c066d44ddd4';
        $cartItemId = 1;

        $cartItemRepository = new EloquentCartItemRepository();

        try {
            $item = $cartItemRepository->searchOrFail($cartId, $cartItemId);

            $cartItemRepository->remove($cartId, $item);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        dd('OK');
    }
}
