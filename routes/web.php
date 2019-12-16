<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get("posts/list" , "PostsController@list");

Route::get("comments/list" , "CommentsController@list");

Route::get("activation/{code}" , 'ActivationController@activation')->name('activation');

Route::post("verification" , 'ActivationController@verification')->name('verification');

Route::resource("posts" , "PostsController");

Route::resource("posts/{post}/comments" , "CommentsController");

Route::get("profile" , "UsersController@profile")->name("profile");

Route::post('profile', 'UsersController@update_image')->name("profile_image");


