<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuaris;
use App\User;
use Request;

class ValidatorGeneralController extends Controller {

    /**
     * Check if email exists.
     *
     * @return Response
     */
    public function email()
    {
        return Usuaris::where('usu_correu', '=', Request::input('email'))->count();
    }

    public function token()
    {
        if(Request::input('id')){
            $token = md5(uniqid(rand(), true));
            $user = Usuaris::find(Request::input('id'));
            $user->token = $token;
            $user->save();
            if(User::where('anticuser', '=', Request::input('id'))->count()) {
                $usuaris = User::where('anticuser', '=', Request::input('id'))->first();
                $usuaris->ultratoken = $token;
                $usuaris->save();
            }
            return "guay";
        }
    }

}
