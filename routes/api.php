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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'Api\AuthController@user');
    Route::post('/logout', 'Api\AuthController@logout');

    Route::apiResource('todos', 'Api\TodoController');
    // Route::get('/todos', 'Api\TodoController@index');
    // //Route::get('/todos/search', 'Api\TodoController@search');
    // Route::get('/todos/{id}', 'Api\TodoController@show');
    // Route::post('/todos', 'Api\TodoController@store');
    // Route::put('/todos/{id}', 'Api\TodoController@update');
    // Route::delete('/todos/{id}', 'Api\TodoController@destroy');

    Route::get('/search/todo', 'Api\SearchController@todo');
    Route::get('/search/todo', 'Api\SearchController@user');
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
