<?php namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Assistance;
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
            $usuaris = User::find($id);
            $usuaris->state_id = Request::input('state');
            $usuaris->save();
        } catch (Exception $e) {
            return 'no';
        }
        $config = Config::find(1);
        if(Request::input('state') == 2){
            if(!Assistance::where('user_id', '=', $id)->count()){
                $assistances = new Assistance;
                $assistances->accio = 'ENTRADA';
                $assistances->user_id = $id;
                $assistances->edition_id = $config->edition_id;
                $assistances->save();
            }else{
                $assistances = Assistance::orderby('created_at', 'desc')->first();
                if($assistances->accio == 'SORTIDA'){
                    $assistances = new Assistance;
                    $assistances->accio = 'ENTRADA';
                    $assistances->user_id = $id;
                    $assistances->edition_id = $config->edition_id;
                    $assistances->save();
                }
            }
        } else {
            if(Assistance::where('user_id', '=', $id)->count()){
                $assistances = Assistance::orderby('created_at', 'desc')->first();
                if($assistances->accio == 'ENTRADA'){
                    $assistances = new Assistance;
                    $assistances->accio = 'SORTIDA';
                    $assistances->user_id = $id;
                    $assistances->edition_id = $config->edition_id;
                    $assistances->save();
                }
            }
        }
        return 'guay';
	}

}
