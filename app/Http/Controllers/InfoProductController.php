<?php

namespace App\Http\Controllers;

use App\Models\Products\Domain\ProductRepository;
use Illuminate\View\View;

class InfoProductController extends Controller
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): View
    {
        $product = $this->repository->search($id);

        return view('product', ['info' => $product]);
    }
}
