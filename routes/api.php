<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Api'], function () {
    # Post
    Route::get('/posts', ['as' => 'api.post.index', 'uses' => 'PostController@index']);
    Route::post('/posts', ['as' => 'api.post.store', 'uses' => 'PostController@store']);

    # Category
    Route::get('/categories', ['as' => 'api.category.index', 'uses' => 'CategoryController@index']);

});
