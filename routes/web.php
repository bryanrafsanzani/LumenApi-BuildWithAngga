<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'index web';
    return $router->app->version();
});


$router->get('/product/index', 'ProductController@index');
$router->post('/product', 'ProductController@create');
$router->get('/product/show/{id}', 'ProductController@show');
$router->put('/product/{id}', 'ProductController@update');
$router->delete('/product/{id}', 'ProductController@delete');


$router->post('/register', 'UserController@register');
$router->get('/login', 'UserController@login');