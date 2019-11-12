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
Route::get('home', "Test\TestController@home");
Route::get('/', "Test\TestController@test");


Route::get('lineas', "Lineas\LineasController@index");

Route::get('productos', "Productos\ProductosController@index");
Route::get('productos-pagina', "Productos\ProductosController@pagination");
Route::get('productos/find/{type}', "Productos\ProductosController@findType");
Route::get('productos/{type}', "Productos\ProductosController@findAll");

Route::post('login', 'Login\LoginController@login');


Route::post('orden_compra/{token}/{id}', 'Orden\OrdenController@realizar_orden')->name('orden_compra');

Route::get('orden/{token}/{id}', 'Orden\OrdenController@index')->name('ordenes');

Route::post('eliminar_orden/{token}/{id}/{orden}', 'Orden\OrdenController@destroy')->name('eliminar_orden');
