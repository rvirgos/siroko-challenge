<?php

use App\Http\Controllers\InfoProductController;
use App\Http\Controllers\ListProductsController;
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

