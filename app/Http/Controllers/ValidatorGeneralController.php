<?php namespace App\Http\Controllers;

use App\Competicio;
use App\Competicionsusersgrups;
use App\Config;
use App\Grup;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notificacio;
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

    public function competicioChange($id)
    {
        $config = Config::find(1);

        $competicio = Competicio::find($id);

        $msg = '';
        $estat = Request::input('estat');

        if($competicio->data_inici > date('Y-m-d H:i:s')){

            if(!(Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())){

                if($estat==1) {
                    $grup = Grup::create([
                        'name' => Auth::user()->username,
                        'edicio_id' => $config->edicio_id,
                        'competicio_id' => $id
                    ]);

                    Competicionsusersgrups::create([
                        'user_id' => Auth::user()->id,
                        'grup_id' => $grup->id,
                        'competicio_id' => $id
                    ]);

                    $msg = 1;
                } else {
                    $msg = 'Ja estas desinscrit';
                }
            } else {
                if($estat==1) {
                    $msg = 'Ja estas inscrit';
                } else {
                    $competi = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();

                    $grupId = $competi->grup_id;

                    $competi->delete();

                    if (!Competicionsusersgrups::where('competicio_id', '=', $id)->where('grup_id', '=', $grupId)->count())
                        Grup::destroy($grupId);

                    $msg = 0;
                }
            }
        }else{
            $msg = 'Inscripció tancada.';
        }
        /*/
                $msg = $estat;

                //*/
        return $msg;
    }


    public function notificacioChange($id)
{
    $grup = Grup::find($id);

    $msg = '';

    $estat = Request::input('estat');

    if(!(Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where(function($query){
        $query->where('estat', '=', 0);
        $query->where('estat', '=', 1, 'OR');
        $query->where('estat', '=', 2, 'OR');
    })->count())){

        if($estat==1) {

            Notificacio::create([
                'interesat' => Auth::user()->id,
                'destinatari' => $id,
                'tipus' => 0,
                'rao' => 0,
                'estat' => 0
            ]);

            $msg = 1;
        } else {
            $msg = 'La petició ja ha estat cancel·lada';
        }

    } else {

        if($estat==1) {

            $msg = 'La petició ja esta enviada';
        } else {

            if(Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('estat', '=', 0)->count()) {
                Notificacio::where('interesat', '=', Auth::user()->id)->where('destinatari', '=', $id)->where('tipus', '=', 0)->where('rao', '=', 0)->where('estat', '=', 0)->first()->delete();

                $msg = 0;
            } else {

                $msg = 'Tens la sol·licitud aceptada';
            }

        }
    }

    /*/
    $msg = $estat;

    //*/
    return $msg;
}

}
