<?php namespace App\Http\Controllers;

use App\Config;
use Auth;
use App\Patrocinador;
use App\Competicio;
use App\Competicionsusersgrups;

class PublicController extends Controller {


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

        $competicions = Competicio::all();

        if (Auth::guest()){
            foreach($competicions as $c){
                $competi[] = array(
                    'id' => $c->id,
                    'nom' => $c->name,
                    'logo' => $c->logo,
                    'triat' => false
                );
            }
        }else{
            foreach($competicions as $c){
                $competi[] = array(
                    'id' => $c->id,
                    'nom' => $c->name,
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
        $data = array();
        return view('web.premis', $data);
    }

    public function competicions()
    {
        $data = array();
        return view('web.competicions', $data);
    }

    public function programa()
    {
        $data = array();
        return view('web.programa', $data);
    }

    public function colaboradors()
    {
        $data = array();
        $data['patrocinadorsgold'] = Patrocinador::where('tipus', '=', '3')->get();
        $data['patrocinadorssilver'] = Patrocinador::where('tipus', '=', '2')->get();
        $data['patrocinadorsbronze'] = Patrocinador::where('tipus', '=', '1')->get();
        return view('web.colaboradors', $data);
    }

    public function cartell()
    {
        $data = array();
        $data['cartell'] = Config::find(1)->edicio->cartell;
        return view('web.cartell', $data);
    }

    public function perfil()
    {
        $data = array();
        return view('web.perfil', $data);
    }

    public function contacta()
    {
        $data = array();
        $data['config'] = Config::find(1);
        return view('web.contacta', $data);
    }
}
