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
use App\Competitionsusersgroups;
use App\Config;
use App\Group;
use App\Notification;
use App\User;

View::composer(array('web.app', 'admin.app'), function($view)
{
    $view->with('config', Config::find(1));

});

View::composer(array('web.sidebar'), function($view)
{
    $config = Config::find(1);
    $compi = Competition::where('edition_id', '=', $config->edition_id)->get();
    $i = 0;
    $competitions = array();
    foreach($compi as $c){
        $competitions[$i]['id'] = $c->id;
        $competitions[$i]['name'] = $c->name;
        $competitions[$i]['logo'] = $c->logo;
        $competitions[$i++]['count'] = Competitionsusersgroups::where('competition_id', '=', $c->id)->count();
    }
    if (!Auth::guest()) {
        $group = Group::with('competition')->whereHas('competitionsusersgroups', function ($q) {

            $q->where('user_id', '=', Auth::user()->id);

        })->whereHas('competition', function ($q) {

            $q->where('number', '!=', 1);

        })->get();

        $noti = array();
        $i = 0;
        foreach($group as $g) {
            if (Competitionsusersgroups::where('competition_id', $g->competition->id)->where('group_id', $g->id)->count() < $g->competition->number) {
                $notifications = Notification::where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->get();
                foreach ($notifications as $n) {
                    $user = User::find($n->interesat);
                    if ($user) {
                        $noti[$i]['user'] = $user;
                        $noti[$i]['notification'] = $n;
                        $noti[$i++]['group'] = $g;
                    }
                }
            }
        }
    }
    if(isset($noti))
        if($noti)
            $view->with('not', $noti);
    $view->with('competitions', $competitions);
    $view->with('competition', Competition::where('edition_id', '=', $config->edition_id)->where('data_inici', '>', date('Y-m-d H:i:s'))->orderby('data_inici', 'asc')->first());

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

Route::get('group/{id}', 'PublicController@group');

Route::get('group', 'PublicController@group');

Route::group(['prefix' => 'notification/equip'], function(){
    Route::post('acceptar/{id}', 'PublicController@notificationEquipAcceptar');
    Route::post('cancelar/{id}', 'PublicController@notificationEquipCancelar');
    Route::post('llegida/{id}', 'PublicController@notificationEquipLlegida');
});

/*
 * User
 */

Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function(){

    Route::get('perfil', 'PublicController@perfil');

    Route::get('notifications', 'PublicController@notifications');

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

    Route::get('/editions', 'AdminController@editions');

    Route::get('/editions/{id}', 'AdminController@editions');

    Route::post('/editions/afegir', 'AdminController@editionsAfegir');

    Route::post('/editions/editar/{id}', 'AdminController@editionsEditar');

    Route::get('/states', 'AdminController@states');

    Route::get('/states/{id}', 'AdminController@states');

    Route::post('/states/afegir', 'AdminController@statesAfegir');

    Route::post('/states/editar/{id}', 'AdminController@statesEditar');

    Route::get('/groups', 'AdminController@groups');

    Route::get('/groups/{id}', 'AdminController@groups');

    Route::post('/groups/afegir', 'AdminController@groupsAfegir');

    Route::post('/groups/editar/{id}', 'AdminController@groupsEditar');

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

    Route::get('/assignments', 'AdminController@assignments');

    Route::post('/assignments/crear', 'AdminController@assignmentsCrear');

    Route::get('/assistances', 'AdminController@assistances');

    Route::post('/assistances/calcul', 'AdminController@assistancesCalcul');

    Route::get('/tokens', 'AdminController@tokens');

    Route::get('/app/assistances/entrada', function(){
        return view('control.assistances.entrada');
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

    Route::resource('/control/assistances','AssistancesController');

    Route::resource('/admin/users','UsersController');

    Route::resource('/admin/competitions','CompetitionController');

    Route::resource('/admin/editions','EditionsController');

    Route::resource('/admin/states','StatesController');

    Route::resource('/admin/groups','GroupsController');

    Route::resource('/admin/motives','MotivesController');

    Route::resource('/admin/sponsors','SponsorsController');

    Route::resource('/admin/presents','PresentsController');

    Route::resource('/admin/rols','RolsController');

    Route::resource('/admin/config','ConfigController', ['only' => 'update']);

    Route::resource('/admin/validacio','ValidacioController', ['only' => 'update']);

    Route::post('admin/users/validacio/email', 'ValidatorGeneralController@email');

    Route::post('admin/users/token', 'ValidatorGeneralController@token');

    Route::post('competition/change/{id}', 'ValidatorGeneralController@competitionChange');

    Route::post('notification/change/{id}', 'ValidatorGeneralController@notificationChange');
});

