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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','api\UserController@login');
Route::get('/posts','api\PostController@index');
Route::get('/post/category', 'api\PostController@cat');
Route::post('/post/search', 'api\PostController@search');

Route::post('/post/store', 'api\PostController@store');
Route::post('/post/show', 'api\PostController@show');
Route::post('/post/update','api\PostController@update');
Route::post('/post/delete', 'api\PostController@destroy');
