<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $route) {
    $route->get('/', 'BackendController@index')->name('backend');

    $route->get('/profile', 'ProfileController@index')->name('profile');


    $route->get('/setting', 'SettingController@index')->name('settings');

    $route->get('/posts/deleted', 'PostController@deleted')->name('posts.deleted');
    $route->resource('/posts', 'PostController');

    $route->get('/categories/deleted', 'CategoryController@deleted')->name('categories.deleted');
    $route->resource('/categories', 'CategoryController');

    $route->resource('subscribers', 'SubscriberController');

});
