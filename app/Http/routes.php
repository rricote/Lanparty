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
use App\Config;

View::composer(array('web.app', 'admin.app'), function($view)
{
    $view->with('config', Config::find(1));

});

Route::get('/', 'PublicController@index');

Route::get('home', function(){
    return Redirect::to('/');
});

Route::get('premis', 'PublicController@premis');

Route::get('colaboradors', 'PublicController@colaboradors');

Route::get('competicions', 'PublicController@competicions');

Route::get('cartell', 'PublicController@cartell');

Route::get('programa', 'PublicController@programa');

Route::get('contacta', 'PublicController@contacta');

Route::get('perfil', 'PublicController@perfil');

/*
 * User
 */

Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function(){

    Route::get('perfil', 'PublicController@perfil');

});
/*
 * Admin
 */

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){

    Route::get('/', 'AdminController@index');

    Route::get('/home', function(){
        return Redirect::to('admin/');
    });

    Route::get('/usuaris', 'AdminController@usuaris');

    Route::get('/competicions', 'AdminController@competicions');

    Route::post('/competicions/afegir', 'AdminController@competicionsAfegir');

    Route::get('/tokens', 'AdminController@tokens');

    Route::get('/app/assistencies/entrada', function(){
        return view('control.assistencies.entrada');
    });

    Route::get('/app/sorteig', function(){
        return view('control.sorteig');
    });
});


/*
 * Varis
 */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api'], function(){

    Route::resource('/control/assistencies','AssistenciesController');

    Route::resource('/admin/users','UsersController');

    Route::resource('/admin/validacio','ValidacioController', ['only' => 'update']);

    Route::post('admin/users/validacio/email', 'ValidatorGeneralController@email');

    Route::post('admin/users/token', 'ValidatorGeneralController@token');
});

