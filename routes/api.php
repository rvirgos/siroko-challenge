<?php

use App\Http\Controllers\Backend\API\ApiCartAddItemController;
use App\Http\Controllers\Backend\API\ApiCartCheckoutController;
use App\Http\Controllers\Backend\API\ApiCartCountItemsController;
use App\Http\Controllers\Backend\API\ApiCartRemoveItemController;
use App\Http\Controllers\Backend\API\ApiCartUpdateItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/add', [ApiCartAddItemController::class, '__invoke'])->name('apiCartAddItem');
Route::put('/update', [ApiCartUpdateItemController::class, '__invoke'])->name('apiCartUpdateItem');
Route::delete('/remove', [ApiCartRemoveItemController::class, '__invoke'])->name('apiCartRemoveItem');
Route::get('/count', [ApiCartCountItemsController::class, '__invoke'])->name('apiCartCountItems');
Route::post('/finish', [ApiCartCheckoutController::class, '__invoke'])->name('apiCartCheckout');
