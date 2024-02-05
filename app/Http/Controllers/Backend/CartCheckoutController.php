<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use HttpException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CartCheckoutController extends Controller
{
    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function __invoke(Request $request): View
    {
        $cartId = $request->get('cart_id');

        $data = [
            'cart_id' => $cartId,
        ];

        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'POST',
            (new Uri(route('apiCartCheckout')))->withPort(env('API_PORT')),
            ['Content-type' => 'application/json'],
            json_encode($data),
        ));

        $code = $response->getStatusCode() ?? Response::HTTP_BAD_REQUEST;
        if ($code !== Response::HTTP_OK) {
            throw new HttpException($response->getReasonPhrase());
        }

        session()->remove('cart');

        return view('checkout');
    }
}
