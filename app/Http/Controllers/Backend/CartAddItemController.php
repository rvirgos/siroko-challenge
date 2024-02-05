<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart\Domain\Cart;
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

class CartAddItemController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws HttpException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if (! session()->has('cart')) {
            session(['cart' => new Cart(uniqid('cart_'))]);
        }

        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');

        $data = [
            'cart_id' => session('cart')->id(),
            'product_id' => $productId,
            'quantity' => $quantity,
        ];

        $response = (new GuzzleClient())->send(new GuzzleRequest(
            'POST',
            (new Uri(route('apiCartAddItem')))->withPort(env('API_PORT')),
            [
                'Content-type' => 'application/json',
            ],
            json_encode($data),
        ));

        if ($response?->getStatusCode() !== Response::HTTP_OK) {
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
        $item = CartItem::make($product, new Quantity($quantity));
        session('cart')->addItem($item);

        return redirect()->route('cartSummary');
    }
}
