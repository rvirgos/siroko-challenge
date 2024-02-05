<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products\Domain\ProductRepository;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CartSummaryController extends Controller
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): View
    {
        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'GET',
            (new Uri(route('apiCartCountItem')))->withPort(env('API_PORT')),
            [
                'Content-type' => 'application/json',
            ],
            json_encode($data),
        ));

        $code = $response->getStatusCode() ?? Response::HTTP_BAD_REQUEST;
        if ($code !== Response::HTTP_OK) {
            throw new HttpException($response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        return view('cart', [
            'items' => session('cart')->items(),
            'count' => $body->count,
            'total' => session('cart')->getTotal(),
        ]);
    }
}
