<?php

use App\Http\Controllers\Backend\CartAddItemController;
use App\Http\Controllers\Backend\CartCheckoutController;
use App\Http\Controllers\Backend\CartRemoveItemController;
use App\Http\Controllers\Backend\CartUpdateItemController;
use App\Http\Controllers\Frontend\CartSummaryController;
use App\Http\Controllers\Frontend\InfoProductController;
use App\Http\Controllers\Frontend\ListProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ListProductsController::class, '__invoke'])->name('listProducts');
Route::get('/{id}/product', [InfoProductController::class, '__invoke'])->name('infoProduct');
Route::prefix('/cart')->group(function () {
    Route::get('/', [CartSummaryController::class, '__invoke'])->name('cartSummary');
    Route::post('/add', [CartAddItemController::class, '__invoke'])->name('cartAddItem');
    Route::post('/update', [CartUpdateItemController::class, '__invoke'])->name('cartUpdateItem');
    Route::post('/remove', [CartRemoveItemController::class, '__invoke'])->name('cartRemoveItem');
    Route::post('/checkout', [CartCheckoutController::class, '__invoke'])->name('cartCheckout');
});
