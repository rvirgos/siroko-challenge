<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        $product = $this->repository->searchOrFail($id);

        return view('product', ['info' => $product]);
    }
}
