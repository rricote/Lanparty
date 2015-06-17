<?php namespace App\Http\Controllers;

use App\Config;
use App\Group;
use App\Notificacio;
use App\User;
use Auth;
use App\Sponsor;
use App\Competition;
use App\Competitionsusersgroups;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;

class PublicController extends Controller
{

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
            $data['competitions'] = Competition::where('edicio_id', '=', $config->edicio_id)->get();
        else {
            $data['competitions'] = Competition::where('edicio_id', '=', $config->edicio_id)->with(['group' => function ($q) {

                $q->whereHas('competition', function ($q) {
                    $q->where('number', '>', 1);

                });

            }, 'competitionsusersgroups' => function ($q) {

                $q->where('user_id', '=', Auth::user()->id)->with('group');

            }])->get();
            $data['equips'] = array();

            foreach ($data['competitions'] as $c) {
                $n = $c->number;
                $id = $c->id;
                foreach ($c->group as $g) {
                    if (Competitionsusersgroups::where('group_id', '=', $g->id)->where('competition_id', '=', $id)->count() < $n)
                        $data['equips'][$g->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->count();
                }
            }

            $group = Grup::with('competition')->whereHas('competitionsusersgrups', function ($q) {

                $q->where('user_id', '=', Auth::user()->id);

            })->whereHas('competition', function ($q) {

                $q->where('number', '!=', 1);

            })->get();

            $noti = array();
            $i = 0;
            foreach($grup as $g) {
                if (Competitionsusersgrups::where('competition_id', $g->competition->id)->where('grup_id', $g->id)->count() < $g->competition->number) {
                    $notificacions = Notificacio::where('destinatari', '=', $g->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->get();
                    foreach ($notificacions as $n) {
                        $user = User::find($n->interesat);
                        if ($user) {
                            $noti[$i]['user'] = $user;
                            $noti[$i]['notificacio'] = $n;
                            $noti[$i++]['grup'] = $g;
                        }
                    }
                }
            }
            if($noti)
                $data['not'] = $noti;
        }

        $data['sponsors'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

        $data['js'] = array('competition');

        return view('web.home', $data);
    }

    public function presents()
    {
        $data = array();
        $config = Config::find(1);
        $data['sponsorsgold'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();
        $data['sponsorssilver'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '2')->get();
        $data['sponsorsbronze'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '1')->get();
        return view('web.presents', $data);
    }

    public function competitions()
    {
        $data = $competitions = array();
        $config = Config::find(1);
        $compi = Competition::where('edicio_id', '=', $config->edicio_id)->get();
        $i = 0;
        foreach ($compi as $c) {
            $competitions[$i]['id'] = $c->id;
            $competitions[$i]['name'] = $c->name;
            $competitions[$i]['logo'] = $c->logo;
            $competitions[$i++]['count'] = Competitionsusersgrups::where('competition_id', '=', $c->id)->count();
        }

        $data['competitions'] = $competitions;

        return view('web.competitions', $data);
    }

    public function competition($id)
    {
        $data = array();

        $config = Config::find(1);

        $data['competition'] = Competition::with('grup')->find($id);

        if (empty($data['competition']))
            return Redirect::to('competitions');

        if (!Auth::guest()) {
            $data['competitionsgrups'] = Competitionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->first();

            $n = $data['competition']->number;

            $data['equips'] = array();

            foreach ($data['competition']->grup as $c) {
                if (Competitionsusersgrups::where('grup_id', '=', $c->id)->where('competition_id', '=', $id)->count() < $n) {
                    $data['equips'][$c->id]['name'] = $c->name;
                    $data['equips'][$c->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $c->id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->count();
                }
            }
        }
        $data['sponsors'] = Sponsor::where('tipus', '=', '3')->where('edicio_id', '=', $config->edicio_id)->get();

        $data['js'] = array('competition');

        return view('web.competition', $data);
    }

    public function competitionAfegir($id)
    {
        $rules = array(
            'nomgrup' => 'required'
        );

        $lloc = (Input::get('lloc')) ? '/' : 'competition/' . $id;

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to($lloc)
                ->withErrors($validator);
        } else {

            $config = Config::find(1);

            $competition = Competition::find($id);

            if ($competition->data_inici <= date('Y-m-d H:i:s'))
                return Redirect::to($lloc)
                    ->withFlashMessage('Inscripció tancada.');

            if (Grup::where('name', '=', Input::get('nomgrup'))->where('edicio_id', '=', $config->edicio_id)->count())
                return Redirect::to($lloc)
                    ->withFlashMessage('Grup ja existent.');

            if (Competitionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->count())
                return Redirect::to($lloc)
                    ->withFlashMessage('Ja estas inscrit.');

            $grup = Grup::create([
                'name' => Input::get('nomgrup'),
                'edicio_id' => $config->edicio_id,
                'competition_id' => $id
            ]);

            Competitionsusersgrups::create([
                'user_id' => Auth::user()->id,
                'grup_id' => $grup->id,
                'competition_id' => $id
            ]);

            return Redirect::to($lloc)
                ->withFlashMessage('Inscrit correctament.');
        }
    }

    public function competitionBorrar($id)
    {

        $competition = Competition::find($id);

        $lloc = (Input::get('lloc')) ? '/' : 'competition/' . $id;

        if ($competition->data_inici <= date('Y-m-d H:i:s'))
            return Redirect::to($lloc)
                ->withFlashMessage('La competició ha començat o acabat.');

        if (!Competitionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->count())
            return Redirect::to($lloc)
                ->withFlashMessage('Ja estas desinscrit.');


        $competi = Competitionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->first();

        $grupId = $competi->grup_id;

        if (Notificacio::where('tipus', '=', 0)->where('destinatari', '=', $grupId)->where('interesat', '=', Auth::user()->id)->count())
            Notificacio::where('tipus', '=', 0)->where('destinatari', '=', $grupId)->where('interesat', '=', Auth::user()->id)->delete();

        $competi->delete();

        if (!Competitionsusersgrups::where('competition_id', '=', $id)->where('grup_id', '=', $grupId)->count())
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
        $data['sponsorsgold'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();
        $data['sponsorssilver'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '2')->get();
        $data['sponsorsbronze'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '1')->get();
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

        $data['sponsors'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

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

        $data['competitionsgrups'] = Competitionsusersgrups::where('user_id', '=', $data['user']->id)->with('grup', 'competition')->whereHas('competition', function ($q) use ($config) {
            $q->where('edicio_id', '=', $config->edicio_id);

        })->get();

        return view('web.perfil', $data);

    }

    public function notificacioEquipAcceptar($id = null)
    {
        $notificacio = Notificacio::find($id);
        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        $grup = Grup::with('competition')->find($notificacio->destinatari);

        Competitionsusersgrups::create([
            'user_id' => $notificacio->interesat,
            'grup_id' => $notificacio->destinatari,
            'competition_id' => $grup->competition->id
        ]);

        $notificacio->update([
            'state' => 1
        ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacioEquipCancelar($id = null)
    {
        $notificacio = Notificacio::find($id);

        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        if($notificacio->state == 3)
            $notificacio->update([
                'state' => 2
            ]);
        else
            $notificacio->update([
                'state' => 3
            ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacioEquipLlegida($id = null)
    {
        $notificacio = Notificacio::find($id);

        $lloc = (Input::get('url'))? Input::get('url') : 'grup/' . $notificacio->destinatari;

        if($notificacio->state == 2)
            $notificacio->update([
                'state' => 0
            ]);
        else if($notificacio->state == 0)
            $notificacio->update([
                'state' => 2
            ]);

        return Redirect::to($lloc)
            ->withFlashMessage('Inscrit correctament.');
    }

    public function notificacions(){
        $data = array();
        $grup = Grup::with('competition')->whereHas('competitionsusersgrups', function ($q) {

            $q->where('user_id', '=', Auth::user()->id);

        })->whereHas('competition', function ($q) {

            $q->where('number', '!=', 1);

        })->get();

        $data['notificacions'] = array();
        $i = 0;
        foreach($grup as $g) {
            if (Competitionsusersgrups::where('competition_id', $g->competition->id)->where('grup_id', $g->id)->count() < $g->competition->number) {
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

            $data['grup'] = Grup::with('competition', 'competitionsusersgrups')->find($id);

            if (empty($data['grup']))
                return Redirect::to('grup');

            if (!Auth::guest()) {

                if (Competitionsusersgrups::where('competition_id', $data['grup']->competition->id)->where('user_id', Auth::user()->id)->where('grup_id', $id)->count())
                    if (Competitionsusersgrups::where('competition_id', $data['grup']->competition->id)->where('grup_id', $id)->count() < $data['grup']->competition->number) {
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
            $grup = Grup::where('edicio_id', '=', $config->edicio_id)->whereHas('competition', function ($q) {
                $q->where('number', '>', 1);

            })->get();

            $i = 0;

            foreach ($grup as $g) {
                $data['grup'][$i]['id'] = $g->id;
                $data['grup'][$i]['name'] = $g->name;
                $data['grup'][$i++]['count'] = Competitionsusersgrups::where('grup_id', '=', $g->id)->count();
            }
        }

        $data['id'] = $id;

        $data['sponsors'] = Sponsor::where('edicio_id', '=', $config->edicio_id)->where('tipus', '=', '3')->get();

        return view('web.grup', $data);

    }

    public function contacta()
    {
        $data = array();
        $data['config'] = Config::find(1);
        return view('web.contacta', $data);
    }
}
