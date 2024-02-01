<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItemRepository;
use App\Models\Cart\Domain\Quantity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCartAddItemController extends Controller
{
    private CartItemRepository $repository;

    public function __construct(CartItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $product = $this->repository->search($request->get('product_id'));
        $quantity = new Quantity($request->get('quantity'));
        $this->repository->save();
    }
}
