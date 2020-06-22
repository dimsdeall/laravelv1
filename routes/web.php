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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/item/getdata', 'ItemController@getdata');
Route::resource('/item', 'ItemController');

Route::get('/itemlokasi/getdata/{iditem}', 'ItemlokasiController@getdata');
Route::resource('/itemlokasi', 'ItemlokasiController');

Route::get('/lokasi/getdata', 'LokasiController@getdata');
Route::resource('/lokasi', 'LokasiController');

Route::get('/kategori/getdata', 'KategoriController@getdata');
Route::resource('/kategori', 'KategoriController');