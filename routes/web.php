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
    return view('welcome');
});
//Route::get('list', function () {
//    return view('list');
//});
Route::get('list','ListController@index');
Route::post('list','ListController@addItem');
Route::post('delete','ListController@deleteItem');
Route::post('update','ListController@UpdateItem');
Route::get('search','ListController@searchItem');
