<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('foobar', function() {
    return 'Hello world';
});

// Route::get('user/{id}/{id2}', function ($id, $id2) {
//     return 'Hello Lart' . $id . 'asd' . $id2;
// });

// Route::get('user/{name?}', function($name = 'Anonymous') {
//     return 'Hello ' . $name;
// });

Route::get('user/view/{username}', 'UserController@viewAction');
Route::post('user/add',            'UserController@addAction');
Route::post('user/verify',         'UserController@verifyAction');

Route::post('gag/add',             'GagController@createAction');