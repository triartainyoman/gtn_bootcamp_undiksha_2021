<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Produksi@index')->name('produksiList');

Route::get('/create', 'Produksi@create')->name('produksiCreate');
Route::post('/insert', 'Produksi@insert')->name('produksiInsert');

Route::get('/edit/{id}', 'Produksi@edit')->name('produksiEdit');
Route::post('/update/{id}', 'Produksi@update')->name('produksiUpdate');

Route::delete('/delete/{id}', 'Produksi@delete')->name('produksiDelete');

Route::post('/bahan/list', 'Produksi@bahan_list')->name('produksiBahanList');
