<?php

use Illuminate\Support\Facades\Route;

Route::get('websites', 'WebsiteController@getAllWebsites');
Route::post('websites', 'WebsiteController@addWebsite');

Route::post('users/register', 'UserController@register');
Route::put('users/subscribe', 'UserController@subscribe');
Route::delete('users/unsubscribe', 'UserController@unSubscribe');

Route::post('posts', 'PostsController@addPost');
