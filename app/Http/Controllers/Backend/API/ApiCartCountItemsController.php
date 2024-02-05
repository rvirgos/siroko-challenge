<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItemRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCartCountItemsController extends Controller
{
    private CartItemRepository $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cartId = $request->get('cart_id');
        try {
            $count = $this->cartItemRepository->countItems($cartId);
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), 403);
        }

        return new JsonResponse([
            'count' => $count,
        ]);
    }
}
