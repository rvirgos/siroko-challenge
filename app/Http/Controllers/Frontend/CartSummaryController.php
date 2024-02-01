<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products\Domain\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartSummaryController extends Controller
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): View
    {
        return view('cart', [
            'items' => session('cart')->items(),
            'total' => session('cart')->getTotal(),
        ]);
    }
}
