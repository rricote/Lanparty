<?php namespace App\Http\Controllers;

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

    public function usuaris()
    {
        $data = array();
        $data['usuaris'] = User::all();
        $data['menu'] = 'usuaris';
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'jquery.maskedinput.min',
            'dataTables.colVis.min',
            'dataTables.colReorder.min',
            'usuaris'
        );
        return view('admin.usuaris', $data);
    }

    public function competicions()
    {
        $data = array();
        $data['menu'] = 'competicions';
        $data['competicions'] = Competicio::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'competicions'
        );
        return view('admin.competicions', $data);
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
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'icons/competicions';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $config = Config::find(1);
                    $number = Input::get('number');
                    if($number > 10)
                        $number = 10;

                    Competicio::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'number' => $number,
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

    public function edicions()
    {
        $data = array();
        $data['menu'] = 'edicions';
        $data['edicions'] = Edicio::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'edicions'
        );
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

    public function estats()
    {
        $data = array();
        $data['menu'] = 'estats';
        $data['estats'] = Estat::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'estats'
        );
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

    public function grups()
    {
        $data = array();
        $data['menu'] = 'grups';
        $data['grups'] = Grup::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'grups'
        );
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
                ->withFlashMessage('Competició creada correctament');
        }
    }

    public function motius()
    {
        $data = array();
        $data['menu'] = 'motius';
        $data['motius'] = Motiu::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'motius'
        );
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
                ->withFlashMessage('Competició creada correctament');
        }
    }

    public function patrocinadors()
    {
        $data = array();
        $data['menu'] = 'patrocinadors';
        $data['patrocinadors'] = Patrocinador::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'patrocinadors'
        );
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
                        ->withFlashMessage('Competició creada correctament');

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

    public function premis()
    {
        $data = array();
        $data['menu'] = 'premis';
        $data['premis'] = Premi::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'premis'
        );
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
                'patrocinador' => Input::get('patrocinador'),
                'edicio_id' => $config->edicio_id
            ]);

            return Redirect::to('admin/premis')
                ->withFlashMessage('Competició creada correctament');

        }
    }

    public function rols()
    {
        $data = array();
        $data['menu'] = 'rols';
        $data['rols'] = Rol::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'rols'
        );
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
                ->withFlashMessage('Competició creada correctament');
        }
    }

    public function config()
    {
        $data = array();
        $data['menu'] = 'config';
        $data['config'] = Config::all();
        $data['js'] = array(
            'jquery.dataTables.min',
            'jquery.dataTables.bootstrap',
            'config'
        );
        return view('admin.config', $data);
    }

    public function configEditar()
    {
        $rules = array(
            'name'    => 'required',
            'number'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/config')
                ->withErrors($validator);
        } else {
            if(Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {

                    $destinationPath = 'icons/config';

                    $extension = Input::file('image')->getClientOriginalExtension();

                    $fileName = rand(11111, 99999) . '.' . $extension;

                    Input::file('image')->move($destinationPath, $fileName);

                    $config = Config::find(1);
                    $number = Input::get('number');
                    if($number > 10)
                        $number = 10;

                    Config::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
                        'number' => $number,
                        'edicio_id' => $config->edicio_id
                    ]);

                    return Redirect::to('admin/config')
                        ->withFlashMessage('Competició creada correctament');

                } else {

                    return Redirect::to('admin/config')
                        ->withInput()
                        ->withFlashMessage('Error al pujar l\'arxiu');
                }
            } else {
                return Redirect::to('admin/config')
                    ->withInput()
                    ->withFlashMessage('No has sel·leccionat cap arxiu');
            }
        }
    }

    public function tokens()
    {
        $data = array();
        $data['menu'] = 'tokens';
        $data['usuaris'] = User::where('ultratoken', '=', '')->get();

        $data['js'] = array(
            'tokens'
        );
        return view('admin.tokens', $data);
    }
}
