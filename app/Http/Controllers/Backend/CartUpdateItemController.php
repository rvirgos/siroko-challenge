<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\Quantity;
use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use HttpException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartUpdateItemController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws HttpException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $cartId = $request->get('cart_id');
        $cartItemId = $request->get('cart_item_id');
        $quantity = $request->get('quantity');

        $data = [
            'cart_id' => $cartId,
            'cart_item_id' => $cartItemId,
            'quantity' => $quantity,
        ];

        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'PUT',
            (new Uri(route('apiCartUpdateItem')))->withPort(env('API_PORT')),
            ['Content-type' => 'application/json'],
            json_encode($data),
        ));

        $code = $response->getStatusCode() ?? Response::HTTP_BAD_REQUEST;
        if ($code !== Response::HTTP_OK) {
            throw new HttpException($response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        $product = new Product(
            $body->product_id,
            $body->name,
            $body->description,
            new Price($body->price, $body->currency),
            $body->image
        );
        $item = CartItem::make($body->item_id, $product, new Quantity($body->quantity));
        session('cart')->updateItem($item);

        return redirect()->route('cartSummary');
    }
}
