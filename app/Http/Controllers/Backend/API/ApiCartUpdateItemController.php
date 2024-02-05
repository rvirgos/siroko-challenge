<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItemRepository;
use App\Models\Cart\Domain\CartRepository;
use App\Models\Cart\Domain\Quantity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCartUpdateItemController extends Controller
{
    private CartRepository $cartRepository;

    private CartItemRepository $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cartId = $request->get('cart_id');
        try {
            $item = $this->cartItemRepository->searchOrFail($cartId, $request->get('cart_item_id'));
            $newQuantity = new Quantity($request->get('quantity'));

            $this->cartItemRepository->update($item, $newQuantity);
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), 403);
        }

        return new JsonResponse([
            'cart_id' => $cartId,
            'item_id' => $item->id(),
            'product_id' => $item->product()->id(),
            'name' => $item->product()->name(),
            'description' => $item->product()->description(),
            'price' => $item->product()->price()->value(),
            'currency' => $item->product()->price()->currency(),
            'image' => $item->product()->image(),
            'quantity' => $item->quantity()->value(),
        ]);
    }
}
