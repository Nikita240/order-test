<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('products', 'API\ProductController')->only(['index', 'show']);

// Route::post('orders/{order}', 'API\OrderController@submit');
Route::apiResource('orders', 'API\OrderController')->only(['store', 'show']);

Route::apiResource('orders/{order}/payment', 'API\PaymentController')->only(['store']);
