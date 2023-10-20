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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('product')->group(function () {
   Route::get('/', [ProductController::class, 'listAllProducts'])->name('product.list.all');
   Route::get('/{id}', [ProductController::class, 'listSingleProduct'])->name('product.list.single');
   Route::post('/', [ProductController::class, 'createProduct'])->name('product.create');
   Route::put('/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
});
