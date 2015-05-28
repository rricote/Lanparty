<?php namespace App\Http\Controllers;

use App\Competicio;
use App\Competicionsusersgrups;
use App\Config;
use App\Grup;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        if($competicio->data_inici > date('Y-m-d H:i:s')){

            if(!(Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->count())){

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

                $competi = Competicionsusersgrups::where('user_id', '=', Auth::user()->id)->where('competicio_id', '=', $id)->first();

                $grupId = $competi->grup_id;

                $competi->delete();

                if(!Competicionsusersgrups::where('competicio_id', '=', $id)->count())
                    Grup::destroy($grupId);

                $msg = 0;
            }
        }else{
            $msg = 'Inscripció tancada.';
        }

        return $msg;
    }

}
