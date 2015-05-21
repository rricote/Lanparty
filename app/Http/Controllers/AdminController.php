<?php namespace App\Http\Controllers;

use App\User;
use App\Competicio;
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
        return view('admin.home');
    }

    public function usuaris()
    {
        $data['usuaris'] = User::all();
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
        return view('admin.competicions');
    }

    public function competicionsAfegir()
    {
        $rules = array(
            'name'    => 'required'
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

                    Competicio::create([
                        'name' => Input::get('name'),
                        'logo' => $fileName,
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

    public function tokens()
    {
        $data['usuaris'] = User::where('ultratoken', '=', '')->get();

        $data['js'] = array(
            'tokens'
        );
        return view('admin.tokens', $data);
    }
}
