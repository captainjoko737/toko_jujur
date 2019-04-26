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

Route::post('login', 'api\auth\AuthController@login');
Route::post('register', 'api\auth\AuthController@register');

Route::post('antrian', 'api\antrian\AntrianController@getNomorAntrian');
Route::get('saldo', 'api\saldo\SaldoController@getSaldo');
Route::get('barang', 'api\barang\BarangController@getBarang');