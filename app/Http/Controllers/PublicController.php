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
            $data['competitions'] = Competition::where('edition_id', '=', $config->edition_id)->get();
        else {
            $data['competitions'] = Competition::where('edition_id', '=', $config->edition_id)->with(['group' => function ($q) {

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
                        $data['equips'][$g->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $g->id)->where('type', '=', 0)->where('reason', '=', 0)->where('state', '=', 0)->count();
                }
            }

            $group = Group::with('competition')->whereHas('competitionsusersgroups', function ($q) {

                $q->where('user_id', '=', Auth::user()->id);

            })->whereHas('competition', function ($q) {

                $q->where('number', '!=', 1);

            })->get();

            $noti = array();
            $i = 0;
            foreach($group as $g) {
                if (Competitionsusersgroups::where('competition_id', $g->competition->id)->where('group_id', $g->id)->count() < $g->competition->number) {
                    $notificacions = Notificacio::where('destinatari', '=', $g->id)->where('type', '=', 0)->where('reason', '=', 0)->where('state', '=', 0)->get();
                    foreach ($notificacions as $n) {
                        $user = User::find($n->interesat);
                        if ($user) {
                            $noti[$i]['user'] = $user;
                            $noti[$i]['notificacio'] = $n;
                            $noti[$i++]['group'] = $g;
                        }
                    }
                }
            }
            if($noti)
                $data['not'] = $noti;
        }

        $data['sponsors'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '3')->get();

        $data['js'] = array('competition');

        return view('web.home', $data);
    }

    public function presents()
    {
        $data = array();
        $config = Config::find(1);
        $data['sponsorsgold'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '3')->get();
        $data['sponsorssilver'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '2')->get();
        $data['sponsorsbronze'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '1')->get();
        return view('web.presents', $data);
    }

    public function competitions()
    {
        $data = $competitions = array();
        $config = Config::find(1);
        $compi = Competition::where('edition_id', '=', $config->edition_id)->get();
        $i = 0;
        foreach ($compi as $c) {
            $competitions[$i]['id'] = $c->id;
            $competitions[$i]['name'] = $c->name;
            $competitions[$i]['logo'] = $c->logo;
            $competitions[$i++]['count'] = Competitionsusersgroups::where('competition_id', '=', $c->id)->count();
        }

        $data['competitions'] = $competitions;

        return view('web.competitions', $data);
    }

    public function competition($id)
    {
        $data = array();

        $config = Config::find(1);

        $data['competition'] = Competition::with('group')->find($id);

        if (empty($data['competition']))
            return Redirect::to('competitions');

        if (!Auth::guest()) {
            $data['competitionsgroups'] = Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->first();

            $n = $data['competition']->number;

            $data['equips'] = array();

            foreach ($data['competition']->group as $c) {
                if (Competitionsusersgroups::where('group_id', '=', $c->id)->where('competition_id', '=', $id)->count() < $n) {
                    $data['equips'][$c->id]['name'] = $c->name;
                    $data['equips'][$c->id]['selected'] = Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $c->id)->where('type', '=', 0)->where('reason', '=', 0)->where('state', '=', 0)->count();
                }
            }
        }
        $data['sponsors'] = Sponsor::where('type', '=', '3')->where('edition_id', '=', $config->edition_id)->get();

        $data['js'] = array('competition');

        return view('web.competition', $data);
    }

    public function competitionAfegir($id)
    {
        $rules = array(
            'nomgroup' => 'required'
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

            if (Group::where('name', '=', Input::get('nomgroup'))->where('edition_id', '=', $config->edition_id)->count())
                return Redirect::to($lloc)
                    ->withFlashMessage('Grup ja existent.');

            if (Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->count())
                return Redirect::to($lloc)
                    ->withFlashMessage('Ja estas inscrit.');

            $group = Group::create([
                'name' => Input::get('nomgroup'),
                'edition_id' => $config->edition_id,
                'competition_id' => $id
            ]);

            Competitionsusersgroups::create([
                'user_id' => Auth::user()->id,
                'group_id' => $group->id,
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

        if (!Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->count())
            return Redirect::to($lloc)
                ->withFlashMessage('Ja estas desinscrit.');


        $competi = Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->first();

        $groupId = $competi->group_id;

        if (Notificacio::where('type', '=', 0)->where('destinatari', '=', $groupId)->where('interesat', '=', Auth::user()->id)->count())
            Notificacio::where('type', '=', 0)->where('destinatari', '=', $groupId)->where('interesat', '=', Auth::user()->id)->delete();

        $competi->delete();

        if (!Competitionsusersgroups::where('competition_id', '=', $id)->where('group_id', '=', $groupId)->count())
            Group::destroy($groupId);

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
        $data['sponsorsgold'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '3')->get();
        $data['sponsorssilver'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '2')->get();
        $data['sponsorsbronze'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '1')->get();
        return view('web.colaboradors', $data);
    }

    public function cartell()
    {
        $data = array();
        $data['cartell'] = Config::find(1)->edition->cartell;
        return view('web.cartell', $data);
    }

    public function perfil($id = null)
    {
        $data = array();

        $config = Config::find(1);

        $data['sponsors'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '3')->get();

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

        $data['competitionsgroups'] = Competitionsusersgroups::where('user_id', '=', $data['user']->id)->with('group', 'competition')->whereHas('competition', function ($q) use ($config) {
            $q->where('edition_id', '=', $config->edition_id);

        })->get();

        return view('web.perfil', $data);

    }

    public function notificacioEquipAcceptar($id = null)
    {
        $notificacio = Notificacio::find($id);
        $lloc = (Input::get('url'))? Input::get('url') : 'group/' . $notificacio->destinatari;

        $group = Group::with('competition')->find($notificacio->destinatari);

        Competitionsusersgroups::create([
            'user_id' => $notificacio->interesat,
            'group_id' => $notificacio->destinatari,
            'competition_id' => $group->competition->id
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

        $lloc = (Input::get('url'))? Input::get('url') : 'group/' . $notificacio->destinatari;

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

        $lloc = (Input::get('url'))? Input::get('url') : 'group/' . $notificacio->destinatari;

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
        $group = Group::with('competition')->whereHas('competitionsusersgroups', function ($q) {

            $q->where('user_id', '=', Auth::user()->id);

        })->whereHas('competition', function ($q) {

            $q->where('number', '!=', 1);

        })->get();

        $data['notificacions'] = array();
        $i = 0;
        foreach($group as $g) {
            if (Competitionsusersgroups::where('competition_id', $g->competition->id)->where('group_id', $g->id)->count() < $g->competition->number) {
                $notificacions = Notificacio::where('destinatari', '=', $g->id)->where('type', '=', 0)->where('reason', '=', 0)->get();

                foreach ($notificacions as $n) {
                    $user = User::find($n->interesat);
                    if ($user) {
                        $data['notificacions'][$i]['user'] = $user;
                        $data['notificacions'][$i]['notificacio'] = $n;
                        $data['notificacions'][$i++]['group'] = $g;
                    }
                }
            }
        }
        return view('web.notificacions', $data);
    }

    public function group($id = null)
    {
        $data = array();
        $config = Config::find(1);

        if ($id != null) {

            $data['group'] = Group::with('competition', 'competitionsusersgroups')->find($id);

            if (empty($data['group']))
                return Redirect::to('group');

            if (!Auth::guest()) {

                if (Competitionsusersgroups::where('competition_id', $data['group']->competition->id)->where('user_id', Auth::user()->id)->where('group_id', $id)->count())
                    if (Competitionsusersgroups::where('competition_id', $data['group']->competition->id)->where('group_id', $id)->count() < $data['group']->competition->number) {
                        $notificacions = Notificacio::where('destinatari', '=', $id)->where('type', '=', 0)->where('reason', '=', 0)->get();
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
            $group = Group::where('edition_id', '=', $config->edition_id)->whereHas('competition', function ($q) {
                $q->where('number', '>', 1);

            })->get();

            $i = 0;

            foreach ($group as $g) {
                $data['group'][$i]['id'] = $g->id;
                $data['group'][$i]['name'] = $g->name;
                $data['group'][$i++]['count'] = Competitionsusersgroups::where('group_id', '=', $g->id)->count();
            }
        }

        $data['id'] = $id;

        $data['sponsors'] = Sponsor::where('edition_id', '=', $config->edition_id)->where('type', '=', '3')->get();

        return view('web.group', $data);

    }

    public function contacta()
    {
        $data = array();
        $data['config'] = Config::find(1);
        return view('web.contacta', $data);
    }
}
