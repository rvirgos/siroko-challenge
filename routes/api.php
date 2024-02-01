<?php

use App\Http\Controllers\Backend\API\ApiCartAddItemController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add', [ApiCartAddItemController::class, '__invoke'])->name('apiCartAddItem');
    Route::put('/update', [ApiCartUpdateItemController::class, '__invoke'])->name('apiCartUpdateItem');
    Route::delete('/remove', [ApiCartRemoveItemController::class, '__invoke'])->name('apiCartRemoveItem');
});
