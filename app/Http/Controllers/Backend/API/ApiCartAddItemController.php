<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\CartItemRepository;
use App\Models\Cart\Domain\CartRepository;
use App\Models\Cart\Domain\Quantity;
use App\Models\Products\Domain\ProductRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCartAddItemController extends Controller
{
    private CartRepository $cartRepository;

    private ProductRepository $productRepository;

    private CartItemRepository $cartItemRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $cartId = $request->get('cart_id');
            $cart = $this->cartRepository->searchOrCreate($cartId);
            $product = $this->productRepository->searchOrFail($request->get('product_id'));
            $quantity = new Quantity($request->get('quantity'));
            $item = CartItem::make(null, $product, $quantity);

            $newItem = $this->cartItemRepository->save($cart, $item);
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), 403);
        }

        return new JsonResponse([
            'cart_id' => $cartId,
            'item_id' => $newItem->id(),
            'product_id' => $newItem->product()->id(),
            'name' => $newItem->product()->name(),
            'description' => $newItem->product()->description(),
            'price' => $newItem->product()->price()->value(),
            'currency' => $newItem->product()->price()->currency(),
            'image' => $newItem->product()->image(),
            'quantity' => $newItem->quantity()->value(),
        ]);
    }
}
