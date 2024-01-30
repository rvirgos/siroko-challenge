<?php

namespace App\Http\Controllers;

use App\Models\Products\Domain\ProductRepository;

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
    }
}
