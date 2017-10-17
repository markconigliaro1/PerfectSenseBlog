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

// Static Routes.
Route::get('/', 'HomeController@getHome')
->name('home');

// Guest Routes.
Route::get('/signup', 'Guest\GuestController@getSignUp')
->middleware('guest')
->name('guest.signup');

Route::post('/signup', 'Guest\GuestController@postSignUp')
->middleware('guest');

Route::get('/signin', 'Guest\GuestController@getSignIn')
->middleware('guest')
->name('guest.signin');

Route::post('/signin', 'Guest\GuestController@postSignIn')
->middleware('guest');

// Auth Routes.
Route::get('/signout', 'Auth\AuthController@getSignOut')
->middleware('auth')
->name('auth.signout');

Route::get('/user/{username}', 'Auth\ProfileController@getProfile')
->middleware('auth')
->name('auth.profile.index');

Route::get('/user/{username}/settings', 'Auth\ProfileController@getProfileSettings')
->middleware('auth')
->name('auth.profile.settings');

Route::post('/user/{username}/settings', 'Auth\ProfileController@postProfileSettings')
->middleware('auth');

// Post routes.
Route::post('/post', 'Auth\PostController@postPost')
->middleware('auth')
->name('auth.post.post');
