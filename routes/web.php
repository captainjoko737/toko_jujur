<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'web'], function () {

	Auth::routes();
	Route::get('/', 'HomeController@index');
	
	Route::delete('/barang/delete', 'web\Barang@drop')->name('barang.drop');
	Route::post('/barang/save', 'web\Barang@save')->name('barang.save');
	Route::resource('barang', 'web\Barang');

	Route::delete('/pelanggan/delete', 'web\Pelanggan@drop')->name('pelanggan.drop');
	Route::post('/pelanggan/save', 'web\Pelanggan@save')->name('pelanggan.save');
	Route::get('/pelanggan/saldo/{id}', 'web\Pelanggan@saldo')->name('pelanggan.saldo');
	Route::post('/pelanggan/saldo', 'web\Pelanggan@postSaldo')->name('pelanggan.postSaldo');
	Route::resource('pelanggan', 'web\Pelanggan');

	Route::resource('laporan', 'web\Laporan');


});