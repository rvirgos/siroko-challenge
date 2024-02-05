<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use HttpException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartRemoveItemController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws HttpException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $cartId = $request->get('cart_id');
        $cartItemId = $request->get('cart_item_id');

        $data = [
            'cart_id' => $cartId,
            'cart_item_id' => $cartItemId,
        ];

        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'DELETE',
            (new Uri(route('apiCartRemoveItem')))->withPort(env('API_PORT')),
            ['Content-type' => 'application/json'],
            json_encode($data),
        ));

        $code = $response->getStatusCode() ?? Response::HTTP_BAD_REQUEST;
        if ($code !== Response::HTTP_OK) {
            throw new HttpException($response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        session('cart')->removeItem($cartItemId);

        return redirect()->route('cartSummary');
    }
}
