<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuaris;
use App\User;
use Request;

class ValidacioController extends Controller {

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id)
	{
        try {
            $user = Usuaris::find($id);
            $user->est_id = Request::input('estat');
            $user->save();
        } catch (Exception $e) {
            return 'no';
        }
        try {
            if(User::where('anticuser', '=', $id)->count() == 0){
                $token = $user->usu_token;
                if(empty($token))
                    $token = '';
                User::create([
                    'dni' => $user->usu_dni,
                    'name' => $user->usu_nom,
                    'cognom1' => $user->usu_cognom1,
                    'cognom2' => $user->usu_cognom2,
                    'username' => $user->usu_nick,
                    'email' => $user->usu_correu,
                    'ultratoken' => $token,
                    'anticuser' => $user->usu_id,
                    'estats_id' => Request::input('estat'),
                    'rols_id' => $user->rol_id,
                ]);
            }else{
                $usuaris = User::where('anticuser', '=', $id)->first();
                $usuaris->estats_id = Request::input('estat');
                $usuaris->save();
            }
        } catch (Exception $e) {
            return 'no';
        }

        return 'guay';
	}

}
