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
    return view('home');
});


Auth::routes();


Route::group( ['prefix'=>'admin/','middleware' => ['auth', 'admin']], function () {

    Route::get('/', 'AdminController@index');
    Route::resource('sets', 'SetsController');
    Route::any('sets/status/{id}', 'SetsController@changeStatus'); //any = (get or post)
    Route::resource('movies', 'MoviesController');
    Route::any('movies/status/{id}', 'MoviesController@changeStatus'); //any = (get or post)

});