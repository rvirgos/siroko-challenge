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

class CartCountController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws HttpException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $cartId = $request->get('cart_id');

        $data = [
            'cart_id' => $cartId,
        ];

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

        return redirect()->route('cartSummary');
    }
}
