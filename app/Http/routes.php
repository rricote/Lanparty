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
use App\Competition;
use App\Competitionsusersgrups;
use App\Config;
use App\Grup;
use App\Notificacio;
use App\User;

View::composer(array('web.app', 'admin.app'), function($view)
{
    $view->with('config', Config::find(1));

});

View::composer(array('web.sidebar'), function($view)
{
    $config = Config::find(1);
    $compi = Competition::where('edicio_id', '=', $config->edicio_id)->get();
    $i = 0;
    $competitions = array();
    foreach($compi as $c){
        $competitions[$i]['id'] = $c->id;
        $competitions[$i]['name'] = $c->name;
        $competitions[$i]['logo'] = $c->logo;
        $competitions[$i++]['count'] = Competitionsusersgrups::where('competition_id', '=', $c->id)->count();
    }
    if (!Auth::guest()) {
        $grup = Grup::with('competition')->whereHas('competitionsusersgrups', function ($q) {

            $q->where('user_id', '=', Auth::user()->id);

        })->whereHas('competition', function ($q) {

            $q->where('number', '!=', 1);

        })->get();

        $noti = array();
        $i = 0;
        foreach($grup as $g) {
            if (Competitionsusersgrups::where('competition_id', $g->competition->id)->where('grup_id', $g->id)->count() < $g->competition->number) {
                $notificacions = Notificacio::where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->get();
                foreach ($notificacions as $n) {
                    $user = User::find($n->interesat);
                    if ($user) {
                        $noti[$i]['user'] = $user;
                        $noti[$i]['notificacio'] = $n;
                        $noti[$i++]['grup'] = $g;
                    }
                }
            }
        }
    }
    if(isset($noti))
        if($noti)
            $view->with('not', $noti);
    $view->with('competitions', $competitions);
    $view->with('competition', Competition::where('edicio_id', '=', $config->edicio_id)->where('data_inici', '>', date('Y-m-d H:i:s'))->orderby('data_inici', 'asc')->first());

});

Route::get('/', 'PublicController@index');

Route::get('home', function(){
    return Redirect::to('/');
});

Route::get('presents', 'PublicController@presents');

Route::get('colaboradors', 'PublicController@colaboradors');

Route::get('competitions', 'PublicController@competitions');

Route::get('competition/{id}', 'PublicController@competition');

Route::get('competition', function(){
    return Redirect::to('competitions');
});
Route::post('competition/afegir/{id}', 'PublicController@competitionAfegir');

Route::post('competition/borrar/{id}', 'PublicController@competitionBorrar');

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

    Route::get('notificacions', 'PublicController@notificacions');

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

    Route::get('/usuaris/{id}', 'AdminController@usuaris');

    Route::post('/usuaris/editar/{id}', 'AdminController@usuarisEditar');

    Route::get('/competitions', 'AdminController@competitions');

    Route::get('/competitions/{id}', 'AdminController@competitions');

    Route::post('/competitions/afegir', 'AdminController@competitionsAfegir');

    Route::post('/competitions/editar/{id}', 'AdminController@competitionsEditar');

    Route::get('/edicions', 'AdminController@edicions');

    Route::get('/edicions/{id}', 'AdminController@edicions');

    Route::post('/edicions/afegir', 'AdminController@edicionsAfegir');

    Route::post('/edicions/editar/{id}', 'AdminController@edicionsEditar');

    Route::get('/states', 'AdminController@states');

    Route::get('/states/{id}', 'AdminController@states');

    Route::post('/states/afegir', 'AdminController@statesAfegir');

    Route::post('/states/editar/{id}', 'AdminController@statesEditar');

    Route::get('/grups', 'AdminController@grups');

    Route::get('/grups/{id}', 'AdminController@grups');

    Route::post('/grups/afegir', 'AdminController@grupsAfegir');

    Route::post('/grups/editar/{id}', 'AdminController@grupsEditar');

    Route::get('/motives', 'AdminController@motives');

    Route::get('/motives/{id}', 'AdminController@motives');

    Route::post('/motives/afegir', 'AdminController@motivesAfegir');

    Route::post('/motives/editar/{id}', 'AdminController@motivesEditar');

    Route::get('/sponsors', 'AdminController@sponsors');

    Route::get('/sponsors/{id}', 'AdminController@sponsors');

    Route::post('/sponsors/afegir', 'AdminController@sponsorsAfegir');

    Route::post('/sponsors/editar/{id}', 'AdminController@sponsorsEditar');

    Route::get('/presents', 'AdminController@presents');

    Route::get('/presents/{id}', 'AdminController@presents');

    Route::post('/presents/afegir', 'AdminController@presentsAfegir');

    Route::post('/presents/editar/{id}', 'AdminController@presentsEditar');

    Route::get('/rols', 'AdminController@rols');

    Route::get('/rols/{id}', 'AdminController@rols');

    Route::post('/rols/afegir', 'AdminController@rolsAfegir');

    Route::post('/rols/editar/{id}', 'AdminController@rolsEditar');

    Route::get('/config', 'AdminController@config');

    Route::post('/config/editar', 'AdminController@configEditar');

    Route::get('/assignacions', 'AdminController@assignacions');

    Route::post('/assignacions/crear', 'AdminController@assignacionsCrear');

    Route::get('/assistencies', 'AdminController@assistencies');

    Route::post('/assistecies/calcul', 'AdminController@assistenciesCalcul');

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

    Route::resource('/admin/competitions','CompetitionController');

    Route::resource('/admin/edicions','EdicionsController');

    Route::resource('/admin/states','StatesController');

    Route::resource('/admin/grups','GrupsController');

    Route::resource('/admin/motives','MotivesController');

    Route::resource('/admin/sponsors','SponsorsController');

    Route::resource('/admin/presents','PresentsController');

    Route::resource('/admin/rols','RolsController');

    Route::resource('/admin/config','ConfigController', ['only' => 'update']);

    Route::resource('/admin/validacio','ValidacioController', ['only' => 'update']);

    Route::post('admin/users/validacio/email', 'ValidatorGeneralController@email');

    Route::post('admin/users/token', 'ValidatorGeneralController@token');

    Route::post('competition/change/{id}', 'ValidatorGeneralController@competitionChange');

    Route::post('notificacio/change/{id}', 'ValidatorGeneralController@notificacioChange');
});

