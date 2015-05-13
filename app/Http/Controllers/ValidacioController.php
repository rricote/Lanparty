<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuaris;
use App\User;
use App\Assistencies;
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
            if(User::where('anticuser', '=', $id)->count() == 1){
                $usuaris = User::where('anticuser', '=', $id)->first();
                $usuaris->estats_id = Request::input('estat');
                $usuaris->save();
            }
        } catch (Exception $e) {
            return 'no';
        }
        if(Request::input('estat') == 2){
            if(!Assistencies::where('usuaris_id', '=', $id)->count()){
                $assistencies = new Assistencies;
                $assistencies->accio = 'ENTRADA';
                $assistencies->usuaris_id = $id;
                $assistencies->save();
            }else{
                $assistencies = Assistencies::orderby('created_at', 'desc')->first();
                if($assistencies->accio == 'SORTIDA'){
                    $assistencies = new Assistencies;
                    $assistencies->accio = 'ENTRADA';
                    $assistencies->usuaris_id = $id;
                    $assistencies->save();
                }
            }
        } else {
            if(Assistencies::where('usuaris_id', '=', $id)->count()){
                $assistencies = Assistencies::orderby('created_at', 'desc')->first();
                if($assistencies->accio == 'ENTRADA'){
                    $assistencies = new Assistencies;
                    $assistencies->accio = 'SORTIDA';
                    $assistencies->usuaris_id = $id;
                    $assistencies->save();
                }
            }
        }

        return 'guay';
	}

}
