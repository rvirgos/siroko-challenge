<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItemRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCartRemoveItemController extends Controller
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
            $item = $this->cartItemRepository->searchOrFail($cartId, $request->get('cart_item_id'));
            $this->cartItemRepository->remove($cartId, $item);
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), 403);
        }

        return new JsonResponse([
            'cart_id' => $cartId,
            'product_id' => $item->product()->id()
        ]);
    }
}
