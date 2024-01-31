<?php

namespace App\Http\Controllers;

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
