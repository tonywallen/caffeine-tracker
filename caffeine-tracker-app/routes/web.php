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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/signIn
    $router->post('signIn', ['uses' => 'AuthController@signIn']);
    // Matches "/api/signOut
    $router->post('signOut', ['uses' => 'AuthController@signOut']);
    // Matches "/api/refreshToken
    $router->get('refreshToken', ['uses' => 'AuthController@refreshToken']);

    // Matches "/api/getUserById
    $router->get('getUserById/{id}', 'UserController@getUserById');
    // Matches "/api/getProfile
    $router->get('getProfile', 'UserController@getProfile');
    // Matches "/api/registerUser
    $router->post('registerUser', 'UserController@registerUser');

    // Matches "/api/getAllDrinks
    $router->get('getAllDrinks', 'DrinkController@getAllDrinks');
    // Matches "/api/getDrinkById
    $router->get('getDrinkById/{id}', 'DrinkController@getDrinkById');
    // Matches "/api/getDrinksConsumedByUser
    $router->get('getDrinksConsumedByUserByDate', 'DrinkController@getDrinksConsumedByUserByDate');
    // Matches "/api/setDrinkConsumedByUser
    $router->post('setDrinkConsumedByUser', 'DrinkController@setDrinkConsumedByUser');
});
