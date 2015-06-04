<?php namespace App\Http\Controllers;

use App\Assistencia;
use App\Edicio;
use App\Estat;
use App\Grup;
use App\Motiu;
use App\Patrocinador;
use App\Premi;
use App\Rol;
use App\User;
use App\Competicio;
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

    /**
     * Create a new controller instance.
     *
     * @return void
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

    public function competicions($id = null)
    {
        $data = array();
        $data['id'] = $id;
        $data['menu'] = 'competicions';
        if(isset($id)){
            $data['competicions'] = Competicio::find($id);

            list($date, $time) = explode(' ',$data['competicions']->data_inici);
            list($any, $mes, $dia) = explode('-', $date);

            $data['date'] = $dia . '-' . $mes . '-' . $any;
            $data['time'] = $time;

            $data['js'] = array(
                'bootstrap-datepicker.min',
                'bootstrap-timepicker.min',
                'competicions'
            );
        }else {
            $data['competicions'] = Competicio::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'bootstrap-datepicker.min',
                'bootstrap-timepicker.min',
                'competicions'
            );
        }
        return view('admin.competicions', $data);
    }

    public function competicionsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'number'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/competicions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $competicio = Competicio::find($id);

                    File::delete('icons/competicions/' . $competicio->logo);

                    $destinationPath = 'icons/competicions';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $competicio->update([
                        'logo' => $fileName
                    ]);

                } else {

                    return Redirect::to('admin/competicions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            }

            if(Input::hasFile('imatge')) {
                if (Input::file('imatge')->isValid()) {

                    $competicio = Competicio::find($id);

                    File::delete('images/competicions/' . $competicio->imatge);

                    $destinationPath = 'images/competicions';

                    $extension = Input::file('imatge')->getClientOriginalExtension();

                    $fileName2 = rand(11111, 99999) . '.' . $extension;

                    Input::file('imatge')->move($destinationPath, $fileName2);

                    $competicio->update([
                        'imatge' => $fileName2
                    ]);

                } else {

                    return Redirect::to('admin/competicions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            }

            $config = Config::find(1);
            $number = Input::get('number');
            if($number > 10)
                $number = 10;

            list($dia,$mes,$any) = explode('-',Input::get('datepicker'));

            Competicio::find($id)->update([
                'name' => Input::get('name'),
                'number' => $number,
                'link' => Input::get('link'),
                'data_inici' => $any . '-' . $mes . '-' . $dia . ' ' . Input::get('timepicker'),
                'edicio_id' => $config->edicio_id
            ]);
            return Redirect::to('admin/competicions')
                ->withFlashMessage('Competició actualitzada correctament');

        }
    }

    public function competicionsAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'number'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/competicions')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image') && Input::hasFile('imatge')) {
                if (Input::file('image')->isValid() && Input::file('imatge')->isValid()) {

                    $destinationPath = 'icons/competicions';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $destinationPath = 'images/competicions';

                    $extension = Input::file('imatge')->getClientOriginalExtension();

                    $fileName2 = rand(11111, 99999) . '.' . $extension;

                    Input::file('imatge')->move($destinationPath, $fileName2);

                    $config = Config::find(1);
                    $number = Input::get('number');
                    if($number > 10)
                        $number = 10;

                    list($dia,$mes,$any) = explode('-',Input::get('datepicker'));

                    Competicio::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'imatge' => $fileName2,
                        'number' => $number,
                        'link' => Input::get('link'),
                        'data_inici' => $any . '-' . $mes . '-' . $dia . ' ' . Input::get('timepicker'),
                        'edicio_id' => $config->edicio_id
                    ]);
                    return Redirect::to('admin/competicions')
                        ->withFlashMessage('Competició creada correctament');

                } else {

                    return Redirect::to('admin/competicions')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/competicions')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function edicions($id = null)
    {
        $data = array();
        $data['menu'] = 'edicions';
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

    public function estats($id = null)
    {
        $data = array();
        $data['menu'] = 'estats';
        $data['id'] = $id;

        if(isset($id)){
            $data['estats'] = Estat::find($id);
            $data['js'] = array(
                'estats'
            );
        }else {
            $data['estats'] = Estat::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'estats'
            );
        }

        return view('admin.estats', $data);
    }

    public function estatsAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/estats')
                ->withErrors($validator);
        } else {

            Estat::create([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/estats')
                ->withFlashMessage('Estat creat correctament');
        }
    }

    public function estatsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/estats')
                ->withErrors($validator);
        } else {

            Estat::find($id)->update([
                'name' => Input::get('name')
            ]);

            return Redirect::to('admin/estats')
                ->withFlashMessage('Estat actualitzat correctament');
        }
    }

    public function grups($id = null)
    {
        $data = array();
        $data['menu'] = 'grups';
        $data['id'] = $id;

        if(isset($id)){
            $data['grups'] = Grup::find($id);
            $data['js'] = array(
                'grups'
            );
        }else {
            $data['grups'] = Grup::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'grups'
            );
        }

        return view('admin.grups', $data);
    }

    public function grupsAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/grups')
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            Grup::create([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/grups')
                ->withFlashMessage('Grup crea correctament');
        }
    }

    public function grupsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/grups')
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            Grup::find($id)->update([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/grups')
                ->withFlashMessage('Grup actualitzat correctament');
        }
    }

    public function motius($id = null)
    {
        $data = array();
        $data['menu'] = 'motius';
        $data['id'] = $id;

        if(isset($id)){
            $data['motius'] = Motiu::find($id);
            $data['js'] = array(
                'motius'
            );
        }else {
            $data['motius'] = Motiu::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'motius'
            );
        }

        return view('admin.motius', $data);
    }

    public function motiusAfegir()
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/motius')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Motiu::create([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/motius')
                ->withFlashMessage('Motiu creat correctament');
        }
    }

    public function motiusEditar($id = null)
    {
        $rules = array(
            'name'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/motius')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Motiu::find($id)->update([
                'name' => Input::get('name'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/motius')
                ->withFlashMessage('Motiu actualitzat correctament');
        }
    }

    public function patrocinadors($id = null)
    {
        $data = array();
        $data['menu'] = 'patrocinadors';
        $data['id'] = $id;

        if(isset($id)){
            $data['patrocinadors'] = Patrocinador::find($id);
            $data['js'] = array(
                'patrocinadors'
            );
        }else {
            $data['patrocinadors'] = Patrocinador::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'patrocinadors'
            );
        }

        return view('admin.patrocinadors', $data);
    }

    public function patrocinadorsAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'tipus'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/patrocinadors')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/patrocinadors';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $config = Config::find(1);

                    Patrocinador::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'tipus' => Input::get('tipus'),
                        'edicio_id' => $config->edicio_id
                    ]);

                    return Redirect::to('admin/patrocinadors')
                        ->withFlashMessage('Patrocinador actualitzat correctament');

                } else {

                    return Redirect::to('admin/patrocinadors')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/patrocinadors')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function patrocinadorsEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'tipus'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/patrocinadors')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'images/patrocinadors';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $patrocinador = Patrocinador::find($id);

                    File::delete('images/patrocinadors/' . $patrocinador->logo);

                    $patrocinador->update([
                        'logo' => $fileName,
                    ]);

                } else {

                    return Redirect::to('admin/patrocinadors/' . $id)
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }

            }

            $config = Config::find(1);

            Patrocinador::find($id)->update([
                'name' => Input::get('name'),
                'tipus' => Input::get('tipus'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/patrocinadors')
                ->withFlashMessage('Patrocinador actualitzat correctament');

        }
    }

    public function premis($id = null)
    {
        $data = array();
        $data['menu'] = 'premis';
        $data['id'] = $id;
        if(isset($id)){
            $data['premis'] = Premi::find($id);
            $data['js'] = array(
                'premis'
            );
        }else {
            $data['premis'] = Premi::all();
            $data['js'] = array(
                'jquery.dataTables.min',
                'jquery.dataTables.bootstrap',
                'premis'
            );
        }
        $patrocinadors = array();

        $patro = Patrocinador::all();

        foreach($patro as $p)
            $patrocinadors[$p->id] = $p->name;

        $data['patrocinadors'] = $patrocinadors;

        return view('admin.premis', $data);
    }

    public function premisAfegir()
    {
        $rules = array(
            'name'    => 'required',
            'patrocinador'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/premis')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Premi::create([
                'name' => Input::get('name'),
                'patrocinador_id' => Input::get('patrocinador'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/premis')
                ->withFlashMessage('Premi creat correctament');

        }
    }

    public function premisEditar($id = null)
    {
        $rules = array(
            'name'    => 'required',
            'patrocinador'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/premis')
                ->withErrors($validator);
        } else {
            $config = Config::find(1);

            Premi::find($id)->update([
                'name' => Input::get('name'),
                'patrocinador_id' => Input::get('patrocinador'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/premis')
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

        $data['motius'] = array();

        $motius = Motiu::where('edicio_id', $config->edicio_id)->get();

        foreach($motius as $m)
            $data['motius'][$m->id] = $m->name;

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
            'motiu'    => 'required',
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

            echo $time_seconds;

            $user = User::all();

            $datainici = Input::get('timepicker');

            if($inici < 10)
                $datainici .= ' 0' . $inici . ':00:00';
            else
                $datainici .= ' ' . $inici . ':00:00';

            $datafinal = Input::get('timepicker') . ' ';

            if($final < 10)
                $datafinal .= ' 0' . $final . ':00:00';
            else
                $datafinal .= ' ' . $final . ':00:00';

            foreach($user as $u){

            }

            /*return Redirect::to('admin/assistencies')
                ->withFlashMessage('Calculat correctament');*/
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
            'patrocinador'    => 'required',
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
                'edicio_id' => Input::get('patrocinador')
            ]);
            return Redirect::to('admin/config')
                ->withFlashMessage('Configuració actualitzada correctament');

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
