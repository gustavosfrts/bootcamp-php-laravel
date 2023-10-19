<?php

use Illuminate\Http\Request;
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

Route::get('/teste', function (){
    return response()->json(['data' => 'success', 'errors' => null], 200);
});

Route::get('/products', function (){
    return response()->json(
        ['data' => \App\Models\product::get()->load(['pictures']),
         'errors' => null],
    200);
});
