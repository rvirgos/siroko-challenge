<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products\Domain\ProductRepository;
use Illuminate\View\View;

class ListProductsController extends Controller
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): View
    {
        $products = $this->repository->all();

        return view('home', ['products' => $products]);
    }
}
