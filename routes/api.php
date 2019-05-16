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
Route::post('verifikasi', 'api\auth\AuthController@verifikasi');

Route::post('antrian', 'api\antrian\AntrianController@getNomorAntrian');
Route::get('saldo', 'api\saldo\SaldoController@getSaldo');
Route::get('barang', 'api\barang\BarangController@getBarang');

Route::post('keranjang', 'api\keranjang\KeranjangController@postKeranjang');
Route::get('keranjang', 'api\keranjang\KeranjangController@getKeranjang');
Route::delete('keranjang', 'api\keranjang\KeranjangController@deleteKeranjang');

Route::post('transaksi', 'api\transaksi\TransaksiController@postTransaksi');
Route::get('transaksi', 'api\transaksi\TransaksiController@getHistoryTransaksi');
Route::get('transaksi/detail', 'api\transaksi\TransaksiController@getHistoryDetailTransaksi');