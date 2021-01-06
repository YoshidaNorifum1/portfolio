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



Route::get('/', 'App\Http\Controllers\WorkController@home');

Route::get('/about', 'App\Http\Controllers\WorkController@about');

Route::get('/works', 'App\Http\Controllers\WorkController@index');

Route::post('/upload','App\Http\Controllers\WorkController@upload');

Route::get('/works/{id}','App\Http\Controllers\WorkController@show');

Route::post('/works/{id}/update','App\Http\Controllers\WorkController@update');

Route::post('/works/{id}/add','App\Http\Controllers\WorkController@add');

Route::post('/works/{id}/edit','App\Http\Controllers\WorkController@edit');

Route::post('/works/{id}/deletepost','App\Http\Controllers\WorkController@deletepost');

Route::post('/works/{id}/delete','App\Http\Controllers\WorkController@delete');


Auth::routes();

