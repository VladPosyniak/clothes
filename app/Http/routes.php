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

    Route::post('/getPostsSub', ['uses' => 'PostsController@getPostsSub', 'as' => 'getPostsSub']);
    Route::post('/getPostsBest', ['uses' => 'PostsController@getPostsBest', 'as' => 'getPostsBest']);


	Route::post('/getPost', ['uses' => 'PostsController@getPost', 'as' => 'getPost']);
	Route::get('/check', ['uses' => 'PostsController@check', 'as' => 'getPost']);

	Route::post('getUser/getself', 'getUser@getself');
	Route::post('getUser/id', 'getUser@getId');


	Route::post('createPost', 'createPost@create');

	Route::post('like', 'likeController@like');
	Route::post('dislike', 'likeController@dislike');

});







Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
