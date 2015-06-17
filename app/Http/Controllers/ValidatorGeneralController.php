<?php namespace App\Http\Controllers;

use App\Competition;
use App\Competitionsusersgroups;
use App\Config;
use App\Group;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Request;

class ValidatorGeneralController extends Controller {

    /**
     * Check if email exists.
     *
     * @return Response
     */
    public function email()
    {
        return User::where('email', '=', Request::input('email'))->count();
    }

    public function token()
    {
        if(Request::input('id')){
            $token = md5(uniqid(rand(), true));

            $usuaris = User::find(Request::input('id'));
            $usuaris->ultratoken = $token;
            $usuaris->save();

            return "guay";
        }
    }

    public function competitionChange($id)
    {
        $config = Config::find(1);

        $competition = Competition::find($id);

        $msg = '';
        $state = Request::input('state');

        if($competition->data_inici > date('Y-m-d H:i:s')){

            if(!(Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->count())){

                if($state==1) {
                    $group = Group::create([
                        'name' => Auth::user()->username,
                        'edition_id' => $config->edition_id,
                        'competition_id' => $id
                    ]);

                    Competitionsusersgroups::create([
                        'user_id' => Auth::user()->id,
                        'group_id' => $group->id,
                        'competition_id' => $id
                    ]);

                    $msg = 1;
                } else {
                    $msg = 'Ja estas desinscrit';
                }
            } else {
                if($state==1) {
                    $msg = 'Ja estas inscrit';
                } else {
                    $competi = Competitionsusersgroups::where('user_id', '=', Auth::user()->id)->where('competition_id', '=', $id)->first();

                    $groupId = $competi->group_id;

                    $competi->delete();

                    if (!Competitionsusersgroups::where('competition_id', '=', $id)->where('group_id', '=', $groupId)->count())
                        Group::destroy($groupId);

                    $msg = 0;
                }
            }
        }else{
            $msg = 'Inscripció tancada.';
        }
        /*/
                $msg = $state;

                //*/
        return $msg;
    }


    public function notificationChange($id)
{
    $group = Group::find($id);

    $msg = '';

    $state = Request::input('state');

    if(!(Notification::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where(function($query){
        $query->where('state', '=', 0);
        $query->where('state', '=', 1, 'OR');
        $query->where('state', '=', 2, 'OR');
    })->count())){

        if($state==1) {

            Notification::create([
                'interesat' => Auth::user()->id,
                'destinatari' => $id,
                'tipus' => 0,
                'rao' => 0,
                'state' => 0
            ]);

            $msg = 1;
        } else {
            $msg = 'La petició ja ha estat cancel·lada';
        }

    } else {

        if($state==1) {

            $msg = 'La petició ja esta enviada';
        } else {

            if(Notification::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->count()) {
                Notification::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('state', '=', 0)->first()->delete();

                $msg = 0;
            } else {

                $msg = 'Tens la sol·licitud aceptada';
            }

        }
    }

    /*/
    $msg = $state;

    //*/
    return $msg;
}

}
