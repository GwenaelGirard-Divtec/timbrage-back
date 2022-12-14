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
    return $router->app->version();
});
// Création du groupr api : http://localhost:8000/api/
$router->group(['prefix' => 'api'], function () use ($router) {

    // Toutes les tâches
    $router->get('timbrages',  ['uses' => 'TimbrageController@showAllTimbrages']);

    $router->get('timbrages/{id}',  ['uses' => 'TimbrageController@showOneTimbrage']);

    $router->get('jours/{date}',  ['uses' => 'TimbrageController@showDay']);

    $router->post('timbrages',  ['uses' => 'TimbrageController@addTimbrage']);

    $router->delete('timbrages/{date}', ['uses' => 'TimbrageController@deleteLastTimbrage']);
});