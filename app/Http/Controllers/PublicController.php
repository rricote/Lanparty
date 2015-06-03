<?php namespace App\Http\Controllers;

use App\Config;
use App\Grup;
use App\Notificacio;
use App\User;
use Auth;
use App\Patrocinador;
use App\Competicio;
use App\Competicionsusersgrups;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;

class PublicController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $data = array();
        $config = Config::find(1);

        if (Auth::guest())
            $data['competicions'] = Competicio::where('edicio_id', '=', $config->edicio_id)->get();
        else {
            $data['competicions'] = Competicio::where('edicio_id', '=', $config->edicio_id)->with(['grup' => function ($q) {

                $q->whereHas('competicio', function ($q) {
                    $q->where('number', '>', 1);

                });

            }, 'competicionsusersgrups' => function ($q) {

                $q->where('user_id', '=', Auth::user()->id)->with('grup');

            }])->get();
            $data['equips'] = array();

            foreach ($data['competicions'] as $c) {
                $n = $c->number;
                $id = $c->id;
                foreach ($c->grup as $g) {
                    if (Competicionsusersgrups::where('grup_id', '=', $g->id)->where('competicio_id', '=', $id)->count() < $n)
                        $data['equips'][$g->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('estat', '=', 0)->count();
                }
            }
        }

        $data['patrocinadors'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

        $data['js'] = array('competicio');

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
        foreach ($compi as $c) {
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

        $data['competicio'] = Competicio::with('grup')->find($id);

        if (empty($data['competicio']))
            return Redirect::to('competicions');

        if (!Auth::guest()) {
            $data['competicionsgrups'] = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();

            $n = $data['competicio']->number;

            $data['equips'] = array();

            foreach ($data['competicio']->grup as $c) {
                if (Competicionsusersgrups::where('grup_id', '=', $c->id)->where('competicio_id', '=', $id)->count() < $n) {
                    $data['equips'][$c->id]['name'] = $c->name;
                    $data['equips'][$c->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $c->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('estat', '=', 0)->count();
                }
            }
        }
        $data['patrocinadors'] = Patrocinador::where('tipus', '=', '3')->where('edicio_id', '=', $config->edicio_id)->get();

        $data['js'] = array('competicio');

        return view('web.competicio', $data);
    }

    public function competicioAfegir($id)
    {
        $rules = array(
            'nomgrup' => 'required'
        );

        $lloc = (Input::get('lloc')) ? '/' : 'competicio/' . $id;

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to($lloc)
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            $competicio = Competicio::find($id);

            if ($competicio->data_inici <= date('Y-m-d H:i:s'))
                return Redirect::to($lloc)
                    ->withFlashMessage('Inscripció tancada.');

            if (Grup::where('name', '=', Input::get('nomgrup'))->where('edicio_id', '=', $config->edicio_id)->count())
                return Redirect::to($lloc)
                    ->withFlashMessage('Grup ja existent.');

            if (Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())
                return Redirect::to($lloc)
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

            return Redirect::to($lloc)
                ->withFlashMessage('Inscrit correctament.');
        }
    }

    public function competicioBorrar($id)
    {

        $competicio = Competicio::find($id);

        $lloc = (Input::get('lloc')) ? '/' : 'competicio/' . $id;

        if ($competicio->data_inici <= date('Y-m-d H:i:s'))
            return Redirect::to($lloc)
                ->withFlashMessage('La competició ha començat o acabat.');

        if (!Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())
            return Redirect::to($lloc)
                ->withFlashMessage('Ja estas desinscrit.');

        $competi = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();

        $grupId = $competi->grup_id;

        $competi->delete();

        if (!Competicionsusersgrups::where('competicio_id', '=', $id)->where('grup_id', '=', $grupId)->count())
            Grup::destroy($grupId);

        return Redirect::to($lloc)
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

    public function perfil($id = null)
    {
        $data = array();

        $config = Config::find(1);

        $data['patrocinadors'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

        if ($id == null) {
            $data['user'] = Auth::user();
            $data['public'] = 0;
        } else {
            $data['user'] = User::find($id);
            $data['public'] = 1;
        }

        list($date, $time) = explode(' ', $data['user']->created_at);
        list($any, $mes, $dia) = explode('-', $date);

        $data['inici'] = $dia . '-' . $mes . '-' . $any;

        $data['competicionsgrups'] = Competicionsusersgrups::where('user_id', '=', $data['user']->id)->with('grup', 'competicio')->whereHas('competicio', function ($q) use ($config) {
            $q->where('edicio_id', '=', $config->edicio_id);

        })->get();

        return view('web.perfil', $data);

    }

    public function notificacioEquipAcceptar($id = null)
    {
        $notificacio = Notificacio::find($id);
        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        $grup = Grup::with('competicio')->find($notificacio->destinatari);

        Competicionsusersgrups::create([
            'user_id' => $notificacio->interesat,
            'grup_id' => $notificacio->destinatari,
            'competicio_id' => $grup->competicio->id
        ]);

        $notificacio->update([
            'estat' => 1
        ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacioEquipCancelar($id = null)
    {
        $notificacio = Notificacio::find($id);

        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        if($notificacio->estat == 3)
            $notificacio->update([
                'estat' => 2
            ]);
        else
            $notificacio->update([
                'estat' => 3
            ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacioEquipLlegida($id = null)
    {
        $notificacio = Notificacio::find($id);

        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        if($notificacio->estat == 2)
            $notificacio->update([
                'estat' => 0
            ]);
        else if($notificacio->estat == 0)
            $notificacio->update([
                'estat' => 2
            ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacions(){
        $grup = Grup::with('competicio')->whereHas('competicionsusersgrups', function ($q) {

            $q->where('user_id', '=', Auth::user()->id);

        })->whereHas('competicio', function ($q) {

            $q->where('number', '!=', 1);

        })->get();

        $data['notificacions'] = array();
        $i = 0;
        foreach($grup as $g) {
            if (Competicionsusersgrups::where('competicio_id', $g->competicio->id)->where('grup_id', $g->id)->count() < $g->competicio->number) {
                $notificacions = Notificacio::where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->get();

                foreach ($notificacions as $n) {
                    $user = User::find($n->interesat);
                    if ($user) {
                        $data['notificacions'][$i]['user'] = $user;
                        $data['notificacions'][$i]['notificacio'] = $n;
                        $data['notificacions'][$i++]['grup'] = $g;
                    }
                }
            }
        }
        return view('web.notificacions', $data);
    }

    public function grup($id = null)
    {
        $data = array();
        $config = Config::find(1);

        if ($id != null) {

            $data['grup'] = Grup::with('competicio', 'competicionsusersgrups')->find($id);

            if (empty($data['grup']))
                return Redirect::to('grup');

            if (!Auth::guest()) {

                if (Competicionsusersgrups::where('competicio_id', $data['grup']->competicio->id)->where('user_id', Auth::user()->id)->where('grup_id', $id)->count())
                    if (Competicionsusersgrups::where('competicio_id', $data['grup']->competicio->id)->where('grup_id', $id)->count() < $data['grup']->competicio->number) {
                        $notificacions = Notificacio::where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->get();
                        $data['notificacions'] = array();
                        $i = 0;
                        foreach($notificacions as $n){
                            $user = User::find($n->interesat);
                            if($user) {
                                $data['notificacions'][$i]['user'] = $user;
                                $data['notificacions'][$i++]['notificacio'] = $n;
                            }
                        }
                    }
            }
        } else {
            $grup = Grup::where('edicio_id', '=', $config->edicio_id)->whereHas('competicio', function ($q) {
                $q->where('number', '>', 1);

            })->get();

            $i = 0;

            foreach ($grup as $g) {
                $data['grup'][$i]['id'] = $g->id;
                $data['grup'][$i]['name'] = $g->name;
                $data['grup'][$i++]['count'] = Competicionsusersgrups::where('grup_id', '=', $g->id)->count();
            }
        }

        $data['id'] = $id;

        $data['patrocinadors'] = Patrocinador::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

        return view('web.grup', $data);

    }

    public function contacta()
    {
        $data = array();
        $data['config'] = Config::find(1);
        return view('web.contacta', $data);
    }
}
