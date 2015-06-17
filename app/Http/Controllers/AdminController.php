<?php namespace App\Http\Controllers;

use App\Assignacio;
use App\Assistencia;
use App\Edicio;
use App\State;
use App\Group;
use App\Motive;
use App\Sponsor;
use App\Present;
use App\Rol;
use App\User;
use App\Competition;
use App\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    public function __construct(){
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $data = array();
        $data['menu'] = 'index';
        return view('admin.home', $data);
    }

    public function usuaris($id = null)
    {
        $data = array();
        $data['menu'] = 'usuaris';
        $data['id'] = $id;

        if(isset($id)){
            $data['usuaris'] = User::find($id);
            $data['js'] = array(
                'usuaris'
            );
        }else {
            $data['usuaris'] = User::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'jquery.maskedinput.min',
                'usuaris'
            );
        }

        return view('admin.usuaris', $data);
    }

    public function usuarisEditar($id = null)
    {
        $rules = array(
            'editardni'    => 'required',
            'editarnom'    => 'required',
            'editarsurname1'    => 'required',
            'editarsurname2'    => 'required',
            'editarusername'    => 'required',
            'email'    => 'required|email',
            'editarpassword'    => 'required|confirmed'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/usuaris/' . $id)
                ->withErrors($validator);
        } else {

            User::find($id)->update([
                'dni' => Input::get('editardni'),
                'name' => Input::get('editarnom'),
                'surname1' => Input::get('editarsurname1'),
                'surname2' => Input::get('editarsurname2'),
                'username' => Input::get('editarusername'),
                'email' => Input::get('email'),
                'password' => Input::get('editarpassword')
            ]);

            return Redirect::to('admin/usuaris')
                ->withFlashMessage('Usuari actualitzat correctament');

        }
    }

    public function competitions($id = null)
    {
        $data = array();
        $data['id'] = $id;
        $data['menu'] = 'competitions';
        if(isset($id)){
            $data['competitions'] = Competition::find($id);

            list($date, $time) = explode(' ',$data['competitions']->data_inici);
            list($any, $mes, $dia) = explode('-', $date);

            $data['date'] = $dia . '-' . $mes . '-' . $any;
            $data['time'] = $time;

            $data['js'] = array(
                'bootstrap-datepicker.min',
                'bootstrap-timepicker.min',
                'competitions'
            );
        }else {
            $data['competitions'] = Competition::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'bootstrap-datepicker.min',
                'bootstrap-timepicker.min',
                'competitions'
            );
        }
        return view('admin.competitions', $data);
    }

    public function competitionsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'number'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/competitions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $competition = Competition::find($id);

                    File::delete('icons/competitions/' . $competition->logo);

                    $destinationPath = 'icons/competitions';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $competition->update([
                        'logo' => $fileName
                    ]);

                } else {

                    return Redirect::to('admin/competitions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            }

            if(Input::hasFile('imatge')) {
                if (Input::file('imatge')->isValid()) {

                    $competition = Competition::find($id);

                    File::delete('images/competitions/' . $competition->imatge);

                    $destinationPath = 'images/competitions';

                    $extension = Input::file('imatge')->getClientOriginalExtension();

                    $fileName2 = rand(11111, 99999) . '.' . $extension;

                    Input::file('imatge')->move($destinationPath, $fileName2);

                    $competition->update([
                        'imatge' => $fileName2
                    ]);

                } else {

                    return Redirect::to('admin/competitions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            }

            $config = Config::find(1);
            $number = Input::get('number');
            if($number > 10)
                $number = 10;

            list($dia,$mes,$any) = explode('-',Input::get('datepicker'));

            Competition::find($id)->update([
                'name' => Input::get('name'),
                'number' => $number,
                'link' => Input::get('link'),
                'data_inici' => $any . '-' . $mes . '-' . $dia . ' ' . Input::get('timepicker'),
                'edicio_id' => $config->edicio_id
            ]);
            return Redirect::to('admin/competitions')
                ->withFlashMessage('Competició actualitzada correctament');

        }
    }

    public function competitionsAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'number'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/competitions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image') && Input::hasFile('imatge')) {
                if (Input::file('image')->isValid() && Input::file('imatge')->isValid()) {

                    $destinationPath = 'icons/competitions';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $destinationPath = 'images/competitions';

                    $extension = Input::file('imatge')->getClientOriginalExtension();

                    $fileName2 = rand(11111, 99999) . '.' . $extension;

                    Input::file('imatge')->move($destinationPath, $fileName2);

                    $config = Config::find(1);
                    $number = Input::get('number');
                    if($number > 10)
                        $number = 10;

                    list($dia,$mes,$any) = explode('-',Input::get('datepicker'));

                    Competition::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'imatge' => $fileName2,
                        'number' => $number,
                        'link' => Input::get('link'),
                        'data_inici' => $any . '-' . $mes . '-' . $dia . ' ' . Input::get('timepicker'),
                        'edicio_id' => $config->edicio_id
                    ]);
                    return Redirect::to('admin/competitions')
                        ->withFlashMessage('Competició creada correctament');

                } else {

                    return Redirect::to('admin/competitions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/competitions')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function editions($id = null)
    {
        $data = array();
        $data['menu'] = 'editions';
        $data['id'] = $id;

        if(isset($id)){
            $data['edicions'] = Edicio::find($id);
            $data['js'] = array(
                'edicions'
            );
        }else {
            $data['edicions'] = Edicio::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'edicions'
            );
        }

        return view('admin.edicions', $data);
    }

    public function edicionsAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/edicions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/cartell';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    Edicio::create([
                        'name' => Input::get('name'),
                        'cartell' => $fileName
                    ]);

                    return Redirect::to('admin/edicions')
                        ->withFlashMessage('Edició creada correctament');

                } else {

                    return Redirect::to('admin/edicions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/edicions')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function edicionsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/edicions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/cartell';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $edicio = Edicio::find($id);

                    File::delete('images/cartell/' . $edicio->cartell);

                    $edicio->update([
                        'cartell' => $fileName
                    ]);

                } else {

                    return Redirect::to('admin/edicions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            }

            Edicio::find($id)->update([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/edicions')
                ->withFlashMessage('Edició actualitzada correctament');

        }
    }

    public function states($id = null)
    {
        $data = array();
        $data['menu'] = 'states';
        $data['id'] = $id;

        if(isset($id)){
            $data['states'] = State::find($id);
            $data['js'] = array(
                'states'
            );
        }else {
            $data['states'] = State::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'states'
            );
        }

        return view('admin.states', $data);
    }

    public function statesAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/states')
                ->withErrors($validator);
        } else {

            State::create([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/states')
                ->withFlashMessage('State creat correctament');
        }
    }

    public function statesEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/states')
                ->withErrors($validator);
        } else {

            State::find($id)->update([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/states')
                ->withFlashMessage('State actualitzat correctament');
        }
    }

    public function groups($id = null)
    {
        $data = array();
        $data['menu'] = 'groups';
        $data['id'] = $id;

        if(isset($id)){
            $data['groups'] = Group::find($id);
            $data['js'] = array(
                'groups'
            );
        }else {
            $data['groups'] = Group::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'groups'
            );
        }

        return view('admin.groups', $data);
    }

    public function groupsAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/groups')
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            Group::create([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/groups')
                ->withFlashMessage('Group crea correctament');
        }
    }

    public function groupsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/groups')
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            Group::find($id)->update([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/groups')
                ->withFlashMessage('Grup actualitzat correctament');
        }
    }

    public function motives($id = null)
    {
        $data = array();
        $data['menu'] = 'motives';
        $data['id'] = $id;

        if(isset($id)){
            $data['motives'] = Motive::find($id);
            $data['js'] = array(
                'motives'
            );
        }else {
            $data['motives'] = Motive::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'motives'
            );
        }

        return view('admin.motives', $data);
    }

    public function motivesAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/motives')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Motive::create([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/motives')
                ->withFlashMessage('Motiu creat correctament');
        }
    }

    public function motivesEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/motives')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Motive::find($id)->update([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/motives')
                ->withFlashMessage('Motiu actualitzat correctament');
        }
    }

    public function sponsors($id = null)
    {
        $data = array();
        $data['menu'] = 'sponsors';
        $data['id'] = $id;

        if(isset($id)){
            $data['sponsors'] = Sponsor::find($id);
            $data['js'] = array(
                'sponsors'
            );
        }else {
            $data['sponsors'] = Sponsor::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'sponsors'
            );
        }

        return view('admin.sponsors', $data);
    }

    public function sponsorsAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'type'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/sponsors')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/sponsors';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $config = Config::find(1);

                    Sponsor::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'type' => Input::get('type'),
                        'edicio_id' => $config->edicio_id
                    ]);

                    return Redirect::to('admin/sponsors')
                        ->withFlashMessage('Patrocinador actualitzat correctament');

                } else {

                    return Redirect::to('admin/sponsors')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/sponsors')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function sponsorsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'type'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/sponsors')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/sponsors';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $sponsor = Sponsor::find($id);

                    File::delete('images/sponsors/' . $sponsor->logo);

                    $sponsor->update([
                        'logo' => $fileName,
                    ]);

                } else {

                    return Redirect::to('admin/sponsors/' . $id)
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }

            }

            $config = Config::find(1);

            Sponsor::find($id)->update([
                'name' => Input::get('name'),
                'type' => Input::get('type'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/sponsors')
                ->withFlashMessage('Patrocinador actualitzat correctament');

        }
    }

    public function presents($id = null)
    {
        $data = array();
        $data['menu'] = 'presents';
        $data['id'] = $id;
        if(isset($id)){
            $data['presents'] = Present::find($id);
            $data['js'] = array(
                'presents'
            );
        }else {
            $data['presents'] = Present::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'presents'
            );
        }
        $sponsors = array();

        $patro = Sponsor::all();

        foreach($patro as $p)
            $sponsors[$p->id] = $p->name;

        $data['sponsors'] = $sponsors;

        return view('admin.presents', $data);
    }

    public function presentsAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'sponsor'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/presents')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Present::create([
                'name' => Input::get('name'),
                'sponsor_id' => Input::get('sponsor'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/presents')
                ->withFlashMessage('Premi creat correctament');

        }
    }

    public function presentsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'sponsor'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/presents')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Present::find($id)->update([
                'name' => Input::get('name'),
                'sponsor_id' => Input::get('sponsor'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/presents')
                ->withFlashMessage('Premi actualitzat correctament');

        }
    }

    public function rols($id = null)
    {
        $data = array();
        $data['menu'] = 'rols';
        $data['id'] = $id;
        if(isset($id)){
            $data['rols'] = Rol::find($id);
            $data['js'] = array(
                'rols'
            );
        }else {
            $data['rols'] = Rol::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'rols'
            );
        }
        return view('admin.rols', $data);
    }

    public function rolsAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/rols')
                ->withErrors($validator);
        } else {

            Rol::create([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/rols')
                ->withFlashMessage('Rol creat correctament');
        }
    }

    public function rolsEditar($id = null)
    {
        if($id == null)
            return Redirect::to('admin/rols');

        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/rols')
                ->withErrors($validator);
        } else {

            Rol::find($id)->update([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/rols')
                ->withFlashMessage('Rol actualitzat correctament');
        }
    }

    public function assistencies()
    {
        $data = array();
        $data['menu'] = 'assistencies';

        $config = Config::find(1);

        $data['motives'] = array();

        $motives = Motive::where('edicio_id', $config->edicio_id)->get();

        foreach($motives as $m)
            $data['motives'][$m->id] = $m->name;

        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'bootstrap-timepicker.min',
            'bootstrap-datepicker.min',
            'assistencies'
        );
        return view('admin.assistencies', $data);
    }

    public function assistenciesCalcul()
    {

        $rules = array(
            'datepicker'    => 'required',
            'timepicker'    => 'required',
            'motive'    => 'required',
            'inici'    => 'required',
            'final'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/assistencies')
                ->withErrors($validator);
        } else {
            $seconds = $minutes = $hours = 0;

            $final = Input::get('final');

            $inici = Input::get('inici');

            $str_time = Input::get('timepicker');

            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

            $user = User::all();

            list($dia,$mes,$any) = explode('-', Input::get('datepicker'));

            if($inici < 10)
                $datainici = $any . '-' . $mes . '-' . $dia . ' 0' . $inici . ':00:00';
            else
                $datainici = $any . '-' . $mes . '-' . $dia . ' ' . $inici . ':00:00';

            if($final < 10)
                $datafinal = $any . '-' . $mes . '-' . $dia . ' 0' . $final . ':00:00';
            else
                $datafinal = $any . '-' . $mes . '-' . $dia . ' ' . $final . ':00:00';

            $msg = '';

            foreach($user as $u){
                $assistencies = Assistencia::where('user_id', '=', $u->id)->where('created_at', '>=', $datainici)->where('created_at', '<=', $datafinal)->get();

                $inicial = '';
                $temp = 0;
                $total = 0;

                foreach($assistencies as $a){

                    if($temp == 0 && $a->action == 'SORTIDA'){
                        $inicial = $datainici;
                        $temp = 1;
                    }

                    if($a->action == 'ENTRADA'){
                        $inicial = $a->created_at;
                        $temp = 1;
                    }

                    if($a->action == 'SORTIDA'){
                        $total += (strtotime($a->created_at) - strtotime($inicial));
                        $temp = 0;
                    }
                }
                if($temp) {
                    $total += (strtotime($datafinal) - strtotime($inicial));
                }

                if(Assignacio::where('user_id', '=', $u->id)->where('motive_id', '=', Input::get('motive'))->count()) {

                    if ($total < $time_seconds) {
                        Assignacio::where('user_id', '=', $u->id)->where('motive_id', '=', Input::get('motive'))->delete();
                        $msg .= 'A l\'usuari ' . $u->username . ' se li borra la seva assignació per incumplir la nova condició.<br>';
                    } else {
                        $msg .= 'A l\'usuari ' . $u->username . ' se li deixa com esta la seva assignació per cumplir la nova condició.<br>';
                    }

                } else {

                    if ($total >= $time_seconds) {
                        Assignacio::create([
                            'user_id' => $u->id,
                            'motive_id' => Input::get('motive')
                        ]);
                        $msg .= 'A l\'usuari ' . $u->username . ' se li crea l\'assignació per cumplir la condició.<br>';
                    } else {
                        $msg .= 'A l\'usuari ' . $u->username . ' no se li crea l\'assignació per incumplir la condició.<br>';
                    }

                }
            }

            return Redirect::to('admin/assistencies')
                ->withFlashMessage($msg);
        }
    }

    public function config()
    {
        $data = array();
        $data['menu'] = 'config';
        $config = Config::first();

        $edicions = Edicio::all();
        foreach($edicions as $e)
            $data['edicions'][$e->id] = $e->name;

        list($date, $time) = explode(' ',$config->data_inici);
        list($any, $mes, $dia) = explode('-', $date);

        $data['config']['date'] = $dia . '-' . $mes . '-' . $any;
        $data['config']['time'] = $time;
        $data['config']['email'] = $config->email;
        $data['config']['edicio'] = $config->edicio_id;

        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'bootstrap-datepicker.min',
            'bootstrap-timepicker.min',
            'config'
        );
        return view('admin.config', $data);
    }

    public function configEditar()
    {
        $rules = array(
            'sponsor'    => 'required',
            'email'    => 'required',
            'datepicker'    => 'required',
            'timepicker'    => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('admin/config')
                ->withErrors($validator);
        } else {
            list($dia,$mes,$any) = explode('-',Input::get('datepicker'));
            Config::find(1)->update([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'data_inici' => $any . '-' . $mes . '-' . $dia . ' ' . Input::get('timepicker'),
                'edicio_id' => Input::get('sponsor')
            ]);
            return Redirect::to('admin/config')
                ->withFlashMessage('Configuració actualitzada correctament');

        }
    }

    public function assignacions()
    {
        $data = array();
        $data['menu'] = 'assignacions';

        $config = Config::find(1);

        $data['motives'] = array();

        $motives = Motive::where('edicio_id', $config->edicio_id)->get();

        foreach($motives as $m)
            $data['motives'][$m->id] = $m->name;

        $usuaris = User::all();

        foreach($usuaris as $u)
            $data['usuaris'][$u->id] = $u->name;

        return view('admin.assignacions', $data);
    }

    public function assignacionsCrear()
    {
        $rules = array(
            'usuaris'    => 'required',
            'motives'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/assignacions')
                ->withErrors($validator);
        } else {
            $msg = '';
            if(!Assignacio::where('user_id', Input::get('usuaris'))->where('motive_id', Input::get('motives'))->count()) {
                Assignacio::create([
                    'user_id' => Input::get('usuaris'),
                    'motive_id' => Input::get('motives')
                ]);
                $msg = 'Assignació creada correctament';
            }else{
                $msg = 'Assignació ja existent';
            }
            return Redirect::to('admin/assignacions')
                ->withFlashMessage($msg);

        }
    }

    public function tokens()
    {
        $data = array();
        $data['menu'] = 'tokens';
        $data['usuaris'] = User::all();

        $data['js'] = array(
            'tokens'
        );
        return view('admin.tokens', $data);
    }
}
