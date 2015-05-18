<?php namespace App\Http\Controllers;

use App\User;

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

    public function tokens()
    {
        $data['usuaris'] = User::where('ultratoken', '=', '')->get();

        $data['js'] = array(
            'tokens'
        );
        return view('admin.tokens', $data);
    }
}
