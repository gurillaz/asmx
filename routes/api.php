<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//Authenticated
Route::middleware('auth')->group(function () {

    Route::post('/offer/add_product', 'OfferController@add_product');
    Route::post('/offer/remove_product', 'OfferController@remove_product');

    Route::post('/order/add_product', 'OrderController@add_product');

});

