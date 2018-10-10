<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $route) {

    $route->post('/posts/bulk-delete','PostController@bulkDelete');

    $route->post('/posts/{id}/featured','PostController@addToFeatured');
    $route->post('/posts/{id}/unfeature','PostController@removeFromFeatured');


    $route->post('/posts/{id}/slidable','PostController@slidable');

    $route->resource('/posts', 'PostController');

    $route->post('/categories/bulk-delete', 'CategoryController@bulkDelete');
    $route->resource('/categories', 'CategoryController');

    $route->get('/all/{table_name}', 'GetAllController@all');

//    $route->resource('/tags', 'TagController');

    $route->post('/profile', 'ProfileController@update');

    $route->post('/setting', 'SettingController@update');

    $route->resource('subscribers', 'SubscriberController');

});