<?php

namespace App\Console\Commands;

use App\Models\Cart\Infrastructure\EloquentCartItemRepository;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use HttpException;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TestCommand extends Command
{
    protected $signature = 'test:test';

    protected $description = 'Command to testing';

    public function handle(): void
    {
        $cartItemRepository = new EloquentCartItemRepository();

        $cartId = 'cart_65c0afddaee7d';
        try {
            $count = $cartItemRepository->countItems($cartId);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        dd($count);



    }
}
