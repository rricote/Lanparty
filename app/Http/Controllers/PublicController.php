<?php namespace App\Http\Controllers;

use App\Config;
use App\Grup;
use Auth;
use App\Patrocinador;
use App\Competicio;
use App\Competicionsusersgrups;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;

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
        $config = Config::find(1);
        $data['patrocinadorsgold'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();
        $data['patrocinadorssilver'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '2')->get();
        $data['patrocinadorsbronze'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '1')->get();
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
        $data['competicionsgrups'] = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();
        $n = $data['competicio']->number;
        $data['equips'] = array();
        foreach($data['competicio']->grup as $c){
            if(Competicionsusersgrups::where('grup_id', '=', $c->id)->where('competicio_id', '=', $id)->count() < $n)
                $data['equips'][$c->id] = $c->name;
        }
        $data['patrocinadors'] = Patrocinador::where('tipus', '=', '3')->where('edicio_id', '=', $config->edicio_id)->get();
        $data['js'] = array('competicio');
        return view('web.competicio', $data);
    }

    public function competicioAfegir($id)
    {
        $rules = array(
            'nomgrup'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('competicio/' . $id)
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            $competicio = Competicio::find($id);

            if($competicio->data_inici <= date('Y-m-d H:i:s'))
                return Redirect::to('competicio/' . $id)
                    ->withFlashMessage('Inscripció tancada.');

            if(Grup::where('name', '=', Input::get('nomgrup'))->where('edicio_id', '=', $config->edicio_id)->count())
                return Redirect::to('competicio/' . $id)
                    ->withFlashMessage('Grup ja existent.');

            if(Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())
                return Redirect::to('competicio/' . $id)
                    ->withFlashMessage('Ja estas inscrit.');

            $grup = Grup::create([
                'name' => Input::get('nomgrup'),
                'edicio_id' => $config->edicio_id,
                'competicio_id' => $id
            ]);

            Competicionsusersgrups::create([
                'user_id' => Auth::user()->id,
                'grup_id' => $grup->id,
                'competicio_id' => $id
            ]);

            return Redirect::to('competicio/' . $id)
                ->withFlashMessage('Inscrit correctament.');
        }
    }

    public function competicioBorrar($id)
    {

        $config = Config::find(1);

        $competicio = Competicio::find($id);

        if($competicio->data_inici <= date('Y-m-d H:i:s'))
            return Redirect::to('competicio/' . $id)
                ->withFlashMessage('La competició ha començat o acabat.');

        if(!Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())
            return Redirect::to('competicio/' . $id)
                ->withFlashMessage('Ja estas desinscrit.');

        $competi = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();

        $grupId = $competi->grup_id;

        $competi->delete();

        if(!Competicionsusersgrups::where('competicio_id', '=', $id)->count())
            Grup::destroy($grupId);

        return Redirect::to('competicio/' . $id)
            ->withFlashMessage('Desinscrit correctament.');
    }

    public function programa()
    {
        $data = array();
        return view('web.programa', $data);
    }

    public function colaboradors()
    {
        $data = array();
        $config = Config::find(1);
        $data['patrocinadorsgold'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();
        $data['patrocinadorssilver'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '2')->get();
        $data['patrocinadorsbronze'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '1')->get();
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
