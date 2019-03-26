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

Route::get('/','ProductController@index')->name('home');



Route::get('/datatables', 'ProductController@allData')->name('datatables.data');

Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products', 'ProductController@index')->name('products.index');
Route::put('/products/{product}', 'ProductController@update')->name('products.update');



// Route::resourceAPI('products', 'ProductController');