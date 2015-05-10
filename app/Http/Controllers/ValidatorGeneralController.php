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

}
