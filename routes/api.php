<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::get('/article/{id}', 'NewsApiController@getNewsById');
Route::get('/news', 'NewsApiController@getNewsByPage');
Route::get('/author/{id}', 'NewsApiController@getNewsByAuthor');
Route::get('/category/{id}', 'NewsApiController@getNewsByCategory');
