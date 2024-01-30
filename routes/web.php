<?php

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

Route::get('/', function () {
    Route::get('/', [ListProductsController::class, '__invoke'])->name('listProducts');
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientsListController::class, '__invoke'])->name('listClients');
    Route::get('/create', [ClientCreateController::class, '__invoke'])->name('addClient');
    Route::get('/{id}/edit', [ClientEditController::class, '__invoke'])->name('editClient');
    Route::get('/{id}/waiting-projects', [ClientWaitProjectController::class, '__invoke'])->name('clientWaitingProject');
});
