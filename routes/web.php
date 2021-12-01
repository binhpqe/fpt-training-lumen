<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|

Link tham khảo: Building a API with Lumen - A PHP framework - Youtube
Github Project: https://github.com/binhpqe/fpt-training-lumen
*/

$app->get('/', function () use ($app) {
    return $app->version();
});



$app->get('/item-list', 'ProductsController@getProducts' );

$app->get('/item/{id}', 'ProductsController@getProduct' );

/*Theo flow của FPT API dùng POST*/

$app->post('/create-item', 'ProductsController@createProduct' );


$app->post('/update-item/{id}', 'ProductsController@updateProduct' );


$app->post('/delete-item/{id}', 'ProductsController@deleteProduct' );


$app->post('/force-delete-item/{id}', 'ProductsController@forceDeleteProduct' );