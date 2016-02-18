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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index');
    Route::get('music', 'MusicController@index');
    Route::get('music/{id}', 'MusicController@show')->where('id', '[0-9]+');

    Route::get('song', 'SongController@index');
    Route::get('song/random', 'SongController@random');
    Route::get('song/{id}', 'SongController@show')->where('id', '[0-9]+');
    Route::get('song/path/{id}', 'SongController@path')->where('id', '[0-9]+');
    Route::get('fm', 'SongController@fm');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@home');
        Route::get('setting', ['middleware' => 'auth', 'uses' => 'UserController@setting']);
        Route::post('setting', ['middleware' => 'auth', 'uses' => 'UserController@dosetting']);
        Route::get('password', ['middleware' => 'auth', 'uses' => 'UserController@password']);
        Route::post('password', ['middleware' => 'auth', 'uses' => 'UserController@dopassword']);

        Route::get('love/{source}/{collection_id}', 'UserController@love')->where(['source' => '[0-9]', 'collection_id'=> '[0-9]+']);
        Route::get('{name}', 'UserController@home');
        Route::get('{name}/home', 'UserController@home');
        Route::get('{name}/song', 'UserController@song');
    });
});


Route::group(['middleware' => 'web'], function() {
    $config = [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'role'
    ];

    Route::group($config, function() {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);
        Route::resource('music', 'MusicController');

        Route::get('song/album/{id}', 'SongController@album')->where('id', '[0-9]+');
        Route::get('song/playlist/{id}', 'SongController@playlist')->where('id', '[0-9]+');
        Route::get('song/search', 'SongController@search');
        Route::resource('song', 'SongController');
    });
});
