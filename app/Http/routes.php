<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'IndexController@index', 'as' => 'home']);
Route::get('post', ['uses' => 'IndexController@index', 'as' => 'home']);
Route::get('user', ['uses' => 'IndexController@index', 'as' => 'home']);
Route::get('auth', ['uses' => 'IndexController@index', 'as' => 'home']);





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['prefix' => 'api'], function () {


    Route::resource('authenticate', 'Authenticate', ['only' => ['index']]);
    Route::post('authenticate/unlink', 'Authenticate@unlink');
    Route::post('authenticate/auth', 'Authenticate@authenticate');
    Route::post('authenticate/google', 'Authenticate@google');

    Route::get('/getPosts', ['uses' => 'PostsController@getPosts', 'as' => 'getPosts']);
Route::post('/getPost', ['uses' => 'PostsController@getPost', 'as' => 'getPost']);
Route::get('/check', ['uses' => 'PostsController@check', 'as' => 'getPost']);



});







Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
