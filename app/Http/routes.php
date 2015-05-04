<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('api/control/assistencies','AssistenciesController');

Route::get('control/assistencies/entrada', function(){
    return view('control.assistencies.entrada');
});

Route::get('premis', 'HomeController@premis');

Route::get('colaboradors', 'HomeController@colaboradors');