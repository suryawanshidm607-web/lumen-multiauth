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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


 $router->get('/posts','PostController@index');
 $router->post('/posts','PostController@store');
 $router->get('/posts/{post}','PostController@show');
 $router->put('/posts/{post}','PostController@update');
 // $router->patch('/posts/{post}','PostController@update');
 $router->delete('/posts/{post}','PostController@destroy');


 $router->get('/comments','CommentController@show');
 $router->put('/comments','CommentController@update');