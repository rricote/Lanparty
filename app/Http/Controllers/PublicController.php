<?php namespace App\Http\Controllers;

use Auth;
use App\Patrocinadors;
use App\CompeticioNom;
use App\Competicions;

class PublicController extends Controller {

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
        $data = $competi = array();

        $competicions = CompeticioNom::all();

        if (Auth::guest()){
            foreach($competicions as $c){
                $competi[] = array(
                    'id' => $c->comp_id,
                    'nom' => $c->comp_nom,
                    'logo' => $c->logo,
                    'triat' => false
                );
            }
        }else{
            foreach($competicions as $c){
                $competi[] = array(
                    'id' => $c->comp_id,
                    'nom' => $c->comp_nom,
                    'logo' => $c->logo,
                    'triat' => false
                );
            }
        }
        $data['competi'] = $competi;

        return view('web.home', $data);
	}

    public function premis()
    {
        return view('web.premis');
    }

    public function colaboradors()
    {
        $data['patrocinadorsgold'] = Patrocinadors::where('tipus', '=', '3')->get();
        $data['patrocinadorssilver'] = Patrocinadors::where('tipus', '=', '2')->get();
        $data['patrocinadorsbronze'] = Patrocinadors::where('tipus', '=', '1')->get();
        return view('web.colaboradors', $data);
    }

    public function cartell()
    {
        return view('web.cartell');
    }
}
