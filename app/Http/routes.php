<?php

Route::group(['prefix' => 'api'], function () {


    Route::resource('authenticate', 'Authenticate', ['only' => ['index']]);
    Route::post('authenticate/unlink', 'Authenticate@unlink');
    Route::post('authenticate/auth', 'Authenticate@authenticate');
    Route::post('authenticate/google', 'Authenticate@google');
    Route::post('authenticate/instagram', 'Authenticate@instagram');

    Route::post('/getPostsSub', 'PostsController@getPostsSub');
    Route::post('/getPostsBest', 'PostsController@getPostsBest');
    Route::post('/getPost', 'PostsController@getPost');
    Route::post('/getWinner', 'PostsController@getWinner');
    Route::post('/search','PostsController@search');
    Route::post('/getTags', 'PostsController@getTags');

	Route::get('/check', ['uses' => 'PostsController@check', 'as' => 'getPost']);

	Route::post('getUser/getself', 'getUser@getself');
    Route::post('getUser/getPhotos', 'getUser@getPhotos');
    Route::post('getUser/profile', 'getUser@profile');


	Route::post('createPost', 'createPost@create');

    Route::post('comments/getComments', 'commentsController@getComments');
    Route::post('comments/createComment', 'commentsController@createComment');
    Route::post('comments/deleteComment', 'commentsController@deleteComment');

	Route::post('like', 'likeController@like');
	Route::post('dislike', 'likeController@dislike');

});



Route::any('{path?}', function()
    {
        return view("index");
    })->where("path", ".+");
