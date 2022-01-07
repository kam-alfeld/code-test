<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'product', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', [ProductController::class, 'list'])->name('api.product.list');
    Route::get('/cart', [ProductController::class, 'cartProducts'])->name('api.product.cart');
    Route::get('/{id}', [ProductController::class, 'show'])->name('api.product.show');
    Route::post('/', [ProductController::class, 'store'])->name('api.product.create');
    Route::post('/attach/{id}', [ProductController::class, 'attach'])->name('api.product.attach');
    Route::post('/detach/{id}', [ProductController::class, 'detach'])->name('api.product.detach');
    Route::delete('/detach/{id}', [ProductController::class, 'destroy'])->name('api.product.destroy');
});
