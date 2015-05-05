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

/*
 * Public
 */

Route::get('/', 'PublicController@index');

Route::get('home', function(){
    return Redirect::to('/');
});

Route::get('premis', 'PublicController@premis');

Route::get('colaboradors', 'PublicController@colaboradors');

Route::get('cartell', 'PublicController@cartell');

/*
 * User
 */



/*
 * Admin
 */

Route::get('admin/', 'AdminController@index');

Route::get('admin/home', function(){
    return Redirect::to('admin/');
});

Route::get('admin/usuaris', 'AdminController@usuaris');

Route::get('admin/usuaris/afegir', 'AdminController@usuaris_afegir');

Route::get('admin/usuaris/editar/{id}', 'AdminController@usuaris_editar');

Route::get('admin/competicions', 'AdminController@competicions');

Route::get('admin/competicions/afegir', 'AdminController@competicions_afegir');

Route::get('admin/competicions/editar/{id}', 'AdminController@competicions_editar');

/*
 * Varis
 */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('api/control/assistencies','AssistenciesController');

Route::get('control/assistencies/entrada', function(){
    return view('control.assistencies.entrada');
});
