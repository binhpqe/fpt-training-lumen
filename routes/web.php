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
Github Project: 
*/

$app->get('/', function () use ($app) {
    return $app->version();
});



$app->get('/item-list', function () use ($app) {
    $results = app('db')->select("SELECT * FROM products");
    return $results;
});

$app->get('/test', 'ProductsController@getProducts' );

/*Theo flow của FPT API dùng POST*/

$app->post('/create-item', 'ProductsController@createProduct' );

$app->post('/update-item/{id}', 'ProductsController@updateProduct' );


$app->post('/delete-item', function () use ($app) {
    return 'O day se update current record';
});
