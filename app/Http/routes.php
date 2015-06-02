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
use App\Competicio;
use App\Competicionsusersgrups;
use App\Config;

View::composer(array('web.app', 'admin.app'), function($view)
{
    $view->with('config', Config::find(1));

});

View::composer(array('web.sidebar'), function($view)
{
    $config = Config::find(1);
    $compi = Competicio::where('edicio_id', '=', $config->edicio_id)->get();
    $i = 0;
    $competicions = array();
    foreach($compi as $c){
        $competicions[$i]['id'] = $c->id;
        $competicions[$i]['name'] = $c->name;
        $competicions[$i]['logo'] = $c->logo;
        $competicions[$i++]['count'] = Competicionsusersgrups::where('competicio_id', '=', $c->id)->count();
    }
    $view->with('competicions', $competicions);
    $view->with('competicio', Competicio::where('edicio_id', '=', $config->edicio_id)->where('data_inici', '>', date('Y-m-d H:i:s'))->orderby('data_inici', 'asc')->first());

});

Route::get('/', 'PublicController@index');

Route::get('home', function(){
    return Redirect::to('/');
});

Route::get('premis', 'PublicController@premis');

Route::get('colaboradors', 'PublicController@colaboradors');

Route::get('competicions', 'PublicController@competicions');

Route::get('competicio/{id}', 'PublicController@competicio');

Route::get('competicio', function(){
    return Redirect::to('competicions');
});
Route::post('competicio/afegir/{id}', 'PublicController@competicioAfegir');

Route::post('competicio/borrar/{id}', 'PublicController@competicioBorrar');

Route::get('cartell', 'PublicController@cartell');

Route::get('programa', 'PublicController@programa');

Route::get('contacta', 'PublicController@contacta');

Route::get('perfil/{id}', 'PublicController@perfil');

Route::get('grup/{id}', 'PublicController@grup');

Route::get('grup', 'PublicController@grup');

Route::group(['prefix' => 'notificacio/equip'], function(){
    Route::post('acceptar/{id}', 'PublicController@notificacioEquipAcceptar');
    Route::post('cancelar/{id}', 'PublicController@notificacioEquipCancelar');
    Route::post('llegida/{id}', 'PublicController@notificacioEquipLlegida');
});

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

    Route::get('/competicions/{id}', 'AdminController@competicions');

    Route::post('/competicions/afegir', 'AdminController@competicionsAfegir');

    Route::post('/competicions/editar/{id}', 'AdminController@competicionsEditar');

    Route::get('/edicions', 'AdminController@edicions');

    Route::get('/edicions/{id}', 'AdminController@edicions');

    Route::post('/edicions/afegir', 'AdminController@edicionsAfegir');

    Route::post('/edicions/editar/{id}', 'AdminController@edicionsEditar');

    Route::get('/estats', 'AdminController@estats');

    Route::get('/estats/{id}', 'AdminController@estats');

    Route::post('/estats/afegir', 'AdminController@estatsAfegir');

    Route::post('/estats/editar/{id}', 'AdminController@estatsEditar');

    Route::get('/grups', 'AdminController@grups');

    Route::get('/grups/{id}', 'AdminController@grups');

    Route::post('/grups/afegir', 'AdminController@grupsAfegir');

    Route::post('/grups/editar/{id}', 'AdminController@grupsEditar');

    Route::get('/motius', 'AdminController@motius');

    Route::get('/motius/{id}', 'AdminController@motius');

    Route::post('/motius/afegir', 'AdminController@motiusAfegir');

    Route::post('/motius/editar/{id}', 'AdminController@motiusEditar');

    Route::get('/patrocinadors', 'AdminController@patrocinadors');

    Route::get('/patrocinadors/{id}', 'AdminController@patrocinadors');

    Route::post('/patrocinadors/afegir', 'AdminController@patrocinadorsAfegir');

    Route::post('/patrocinadors/editar/{id}', 'AdminController@patrocinadorsEditar');

    Route::get('/premis', 'AdminController@premis');

    Route::get('/premis/{id}', 'AdminController@premis');

    Route::post('/premis/afegir', 'AdminController@premisAfegir');

    Route::post('/premis/editar/{id}', 'AdminController@premisEditar');

    Route::get('/rols', 'AdminController@rols');

    Route::get('/rols/{id}', 'AdminController@rols');

    Route::post('/rols/afegir', 'AdminController@rolsAfegir');

    Route::post('/rols/editar/{id}', 'AdminController@rolsEditar');

    Route::get('/config', 'AdminController@config');

    Route::post('/config/editar', 'AdminController@configEditar');

    Route::get('/assistencies', 'AdminController@assistencies');

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

    Route::resource('/admin/competicions','CompeticionsController');

    Route::resource('/admin/edicions','EdicionsController');

    Route::resource('/admin/estats','EstatsController');

    Route::resource('/admin/grups','GrupsController');

    Route::resource('/admin/motius','MotiusController');

    Route::resource('/admin/patrocinadors','PatrocinadorsController');

    Route::resource('/admin/premis','PremisController');

    Route::resource('/admin/rols','RolsController');

    Route::resource('/admin/config','ConfigController', ['only' => 'update']);

    Route::resource('/admin/validacio','ValidacioController', ['only' => 'update']);

    Route::post('admin/users/validacio/email', 'ValidatorGeneralController@email');

    Route::post('admin/users/token', 'ValidatorGeneralController@token');

    Route::post('competicio/change/{id}', 'ValidatorGeneralController@competicioChange');

    Route::post('notificacio/change/{id}', 'ValidatorGeneralController@notificacioChange');
});

