<?php namespace App\Http\Controllers;

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
    public function __construct(){}

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
        return view('admin.usuaris');
    }

    public function usuaris_afegir()
    {
        return view('admin.usuaris_afegir');
    }

    public function usuaris_editar()
    {
        return view('admin.usuaris_editar');
    }

    public function competicions()
    {
        return view('admin.competicions');
    }
}
