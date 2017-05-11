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


/**
* Auth::routes() without Register
*
*
*/
Route::post('login', 'Auth\LoginController@login');
Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');


/**
* Only for auth
*
*
*/
Route::group(['middleware' => 'auth'], function() {

    Route::get('/admin', function(){
        return view('admin.pages.home');
    })->name('admin');

});


/**
* Only for admins
*
*
*/
Route::group(['middleware' => 'admin'], function() {

    Route::resource('/admin/categories', 'CategoryController', ['except' => 'show']);
    Route::resource('/admin/media', 'MediaController', ['only' => 'index']);
    Route::resource('/admin/media/photos', 'PhotoController', ['except' => 'show']);
    Route::resource('/admin/posts', 'PostController');
    Route::resource('/admin/tags', 'TagController', ['except' => 'show']);
    Route::resource('/admin/users', 'UserController', ['except' => 'show']);
    Route::post('/admin/tags/ajax', 'TagController@ajaxStore')->name('tags.ajaxStore');
    Route::put('/admin/comments/active/{comment}', 'CommentController@ajaxChangeActive')->name('comments.ajaxChangeActive');
    Route::put('/admin/replies/active/{reply}', 'CommentReplyController@ajaxChangeActive')->name('replies.ajaxChangeActive');
    Route::put('/admin/posts/active/{post}', 'PostController@ajaxChangeActive')->name('posts.ajaxChangeActive');
    Route::put('/admin/users/active/{user}', 'UserController@ajaxChangeActive')->name('users.ajaxChangeActive');

});


/**
* Pages fo admin but store actions for guest
*
*
*/
Route::resource('/admin/comments', 'CommentController', ['except' => ['create', 'edit']]);
Route::resource('/admin/comment/replies', 'CommentReplyController', ['except' => ['create', 'edit', 'show']]);
