<?php

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('users', 'UserController');

Route::name('backend.')
    ->prefix('backend')
    ->namespace('Backend')
    ->middleware(['auth'])
    ->group(base_path('routes/backend.php'));


Route::name('ajax.')
    ->prefix('ajax')
    ->namespace('Ajax')
//    ->middleware(['auth'])
    ->group(base_path('routes/ajax.php'));


Route::get('/', 'LandingPageController@home');

Route::resource('posts', 'PostController');

Route::namespace('Frontend')
//    ->middleware(['auth'])
    ->group(function () {
        Route::get('categories/{slug}/posts', 'PostController@categoryPosts')->name('categories.posts');
        Route::resource('categories', 'CategoryController');
    });
