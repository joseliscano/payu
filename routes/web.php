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

Route::get('/', 'HomeController@index');
Route::post('/addToCart', 'HomeController@store');
Route::get('/showCart', 'CartController@index');
Route::post('/order', 'CartController@store');
Route::get('/showOrders', 'CartController@create');
Route::delete('/cancelOrder/{referenceCode}', 'CartController@destroy');