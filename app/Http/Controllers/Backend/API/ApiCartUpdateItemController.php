<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\Quantity;
use App\Models\Products\Domain\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApiCartUpdateItemController extends Controller
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        if (! session()->has('cart')) {
            session(['cart' => new Cart()]);
        }

        $product = $this->repository->search($request->get('product_id'));
        $quantity = new Quantity($request->get('quantity'));
        $item = CartItem::make($product, $quantity);
        session('cart')->addItem($item);

        return redirect()->route('cartSummary');
    }
}
