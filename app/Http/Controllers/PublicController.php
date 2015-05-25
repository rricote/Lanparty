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
        $config = Config::find(1);
        $competicions = Competicio::where('edicio_id', '=', $config->edicio_id)->get();

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
        $data = $competicions = array();
        $config = Config::find(1);
        $compi = Competicio::where('edicio_id', '=', $config->edicio_id)->get();
        $i = 0;
        foreach($compi as $c){
            $competicions[$i]['id'] = $c->id;
            $competicions[$i]['name'] = $c->name;
            $competicions[$i]['logo'] = $c->logo;
            //$competicions[$i]['number'] = $c->number;
            $competicions[$i++]['count'] = Competicionsusersgrups::where('competicio_id', '=', $c->id)->count();
        }

        $data['competicions'] = $competicions;

        return view('web.competicions', $data);
    }

    public function competicio($id)
    {
        $data = array();
        $config = Config::find(1);
        $data['competicio'] = Competicio::find($id);
        /*
        $config = Config::find(1);
        $compi = Competicio::where('edicio_id', '=', $config->edicio_id)->get();
        $i = 0;
        foreach($compi as $c){
            $competicions[$i]['id'] = $c->id;
            $competicions[$i]['name'] = $c->name;
            $competicions[$i]['logo'] = $c->logo;
            //$competicions[$i]['number'] = $c->number;
            $competicions[$i++]['count'] = Competicionsusersgrups::where('competicio_id', '=', $c->id)->count();
        }

        $data['competicions'] = $competicions;//*/

        $data['patrocinadors'] = Patrocinador::where('tipus', '=', '3')->where('edicio_id', '=', $config->edicio_id)->get();

        return view('web.competicio', $data);
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
