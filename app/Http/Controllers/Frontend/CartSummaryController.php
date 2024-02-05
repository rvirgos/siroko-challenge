<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products\Domain\ProductRepository;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use HttpException;
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

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function __invoke(Request $request): View
    {

        return view('cart', [
            'items' => session('cart')->items(),
            'count' => $this->getCount(),
            'total' => session('cart')->getTotal(),
        ]);
    }

    private function getCount(): int
    {
        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'GET',
            (new Uri(route('apiCartCountItems')))->withPort(env('API_PORT')),
            [
                'Content-type' => 'application/json',
            ],
            json_encode(['cart_id' => session('cart')->id()]),
        ));

        $code = $response->getStatusCode() ?? Response::HTTP_BAD_REQUEST;
        if ($code !== Response::HTTP_OK) {
            throw new HttpException($response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        return $body->count;
    }
}
